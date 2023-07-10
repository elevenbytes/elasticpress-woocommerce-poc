<?php
/**
 * Class related for WP taxonomy customizations.
 *
 * @package elbytes-ep-woo
 */

/**
 * Class related for WP taxonomy customizations.
 */
class EP_Woo_WP_Taxonomy
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        // Remove products per term count calculation on frontend.
        if( ! is_admin() || wp_doing_ajax() ) {
            remove_filter( 'get_terms', 'wc_change_term_counts', 10, 2 );
        }

		if( ! wp_doing_cron() ) {
			remove_action( 'transition_post_status', '_update_term_count_on_transition_post_status' );

			add_filter( 'woocommerce_product_recount_terms', '__return_false' );
			add_action( 'transition_post_status', [ $this, 'maybe_update_term_count_on_transition_post_status' ], 10, 3 );
		}
    }

	/**
	 * Update terms count on transition post status.
	 *
	 * @param string   $new_status New post status.
	 * @param string   $old_status Old post status.
	 * @param WP_Post  $post       Post object.
	 */
	public function maybe_update_term_count_on_transition_post_status( string $new_status, string $old_status, WP_Post $post ) {
		if( $post->post_type === 'product' ) {
			return false;
		}

		// Update counts for the post's terms if not woocommerce product.
		foreach ( (array) get_object_taxonomies( $post->post_type ) as $taxonomy ) {
			$tt_ids = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'tt_ids' ) );
			wp_update_term_count( $tt_ids, $taxonomy );
		}
	}

	public static function elbytes_update_terms_count() {
		$taxonomies        = array('product_cat','product_tag');
		$wc_product_terms  = [];
		$product_terms_ids = [];

		foreach ( $taxonomies as $taxonomy ) {
			$terms = get_terms(
				[
					'taxonomy'   => $taxonomy,
					'hide_empty' => false,
				]
			);

			if ( $terms && ! is_wp_error( $terms ) ) {
				if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
					error_log( 'Updating terms count for taxonomy: ' . $taxonomy );
					error_log( 'Terms: ' . count( $terms ) );
				}

				foreach ( $terms as $term ) {
					$wc_product_terms[ $term->term_id ] = $term->parent;

					$product_terms_ids[] = $term->term_id;
				}

				// Update woocommerce related term count.
				_wc_term_recount( $wc_product_terms, get_taxonomy( $taxonomy ), false, false );

				// Update wordpress related term count.
				wp_update_term_count( $product_terms_ids, $taxonomy );
			}
		}
	}
}
