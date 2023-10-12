<?php
/**
 * Class related for WP taxonomy customizations.
 *
 * @package elbytes-ep-woo
 */

/**
 * Class related for WP taxonomy customizations.
 */
class EP_Woo_WC_Product {
    /**
     * Class constructor.
     */
    public function __construct() {
		add_filter( 'woocommerce_product_pre_search_products', [ $this, 'elastic_press_products_search' ], 10, 6 );

		add_filter( 'ep_formatted_args', [ $this, 'ignore_parent_product_sort' ], 10, 3 );
    }

	/**
	 * Ignore sort by ProductParent because there is not such field in the index.
	 *
	 * @param $formatted_args
	 * @param $args
	 * @param $wp_query
	 *
	 * @return mixed
	 */
	public function ignore_parent_product_sort( $formatted_args, $args, $wp_query ) {
		if ( isset( $formatted_args['sort'] ) ) {
			$formatted_args['sort'] = array_filter(
				$formatted_args['sort'],
				function( $el ) {
					return array_key_first( $el ) !== 'ProductParent';
				}
			);
		}

		return $formatted_args;
	}

	/**
	 * Custom products search using ElasticPress.
	 *
	 * @param $result
	 * @param $term
	 * @param $type
	 * @param $include_variations
	 * @param $all_statuses
	 * @param $limit
	 *
	 * @return mixed
	 */
	public function elastic_press_products_search( $result, $term, $type, $include_variations, $all_statuses, $limit ) {
		if ( isset( $_GET['action'] ) && $_GET['action'] === 'woocommerce_json_search_products_and_variations' ) {
//			var_dump( $_GET );
//			var_dump( $result, $term, $type, $include_variations, $all_statuses, $limit );
		}

		return $result;
	}
}
