<?php
/**
 * Class related for WP meta customizations.
 *
 * @package elbytes-ep-woo
 */

/**
 * Class related for WP meta customizations.
 */
class EP_Woo_WP_Meta
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        add_action( 'add_meta_boxes' , [ $this, 'remove_post_custom_fields_metabox' ], 999 );
    }

    /**
     * Remove Custom Fields meta box from all post types
     */
    public function remove_post_custom_fields_metabox() {
        $types = get_post_types([], 'names');
        foreach($types as $type) {
            remove_meta_box( 'postcustom' , $type , 'normal' );
        }
    }
}
