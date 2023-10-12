<?php
/**
 * Class related for WP taxonomy customizations.
 *
 * @package elbytes-ep-woo
 */

use Automattic\WooCommerce\Utilities\OrderUtil;

/**
 * Class related for WP taxonomy customizations.
 */
class EP_Woo_WC_Order {
    /**
     * Class constructor.
     */
    public function __construct() {
		add_filter( 'woocommerce_customer_pre_search_customers', [ $this, 'search_woo_customer_hpos' ], 10, 3 );
    }

	public function search_woo_customer_hpos( $result, $term, $limit ) {
		if ( class_exists( 'Automattic\WooCommerce\Utilities\OrderUtil' ) && OrderUtil::custom_orders_table_usage_is_enabled() ) {
			global $wpdb;

			$limit   = 20;
			$term    = '%' . $term . '%';
			$results = $wpdb->get_results( // phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery
				$wpdb->prepare(
					"SELECT user_id FROM {$wpdb->prefix}wc_customer_lookup
					WHERE CONCAT(first_name, ' ', last_name) LIKE %s
					OR username  LIKE %s
					OR email LIKE %s",
					$term,
					$term,
					$term
				),
				ARRAY_A
			);

			$results = array_slice( $results, 0, $limit );

			$result = [];
			foreach ( $results as $item ) {
				$result[] = $item['user_id'];
			}
		}

		return $result;
	}
}
