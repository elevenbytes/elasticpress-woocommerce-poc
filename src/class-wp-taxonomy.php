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
    }
}
