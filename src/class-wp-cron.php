<?php
/**
 * Class related for WP taxonomy customizations.
 *
 * @package elbytes-ep-woo
 */

/**
 * Class related for WP taxonomy customizations.
 */
class EP_Woo_WP_Cron
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
	    if ( ! wp_next_scheduled( 'elbytes_update_terms_count' ) ) {
		    wp_schedule_event( time(), 'hourly', 'elbytes_update_terms_count' );
	    }

	    add_action( 'elbytes_update_terms_count', [ $this, 'elbytes_update_terms_count_callback' ] );

    }

	public function elbytes_update_terms_count_callback() {
		if( class_exists( 'EP_Woo_WP_Taxonomy' ) ) {
			EP_Woo_WP_Taxonomy::elbytes_update_terms_count();
		}
	}
}
