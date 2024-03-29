<?php
/**
 * Plugin functions initialization class.
 *
 * @package elbytes-ep-woo
 */

/**
 * Plugin functions initialization class.
 */
class EP_Woo_Init
{
    /**
     * Constructor
     */
    public function __construct() {
        $this->includes();
        $this->init();
    }

    /**
     * Include plugin files.
     */
    private function includes() {
	    require_once ELBYTES_EP_WOO_SRC_PATH . 'class-wp-cron.php';
        require_once ELBYTES_EP_WOO_SRC_PATH . 'class-elastic-press.php';
        require_once ELBYTES_EP_WOO_SRC_PATH . 'class-wp-taxonomy.php';
        require_once ELBYTES_EP_WOO_SRC_PATH . 'class-wp-meta.php';
	    require_once ELBYTES_EP_WOO_SRC_PATH . 'class-wc-product.php';
	    require_once ELBYTES_EP_WOO_SRC_PATH . 'class-wc-order.php';
    }

    /**
     * Init main functions class.
     *
     * @return void
     */
    private function init() {
	    $elastic_press_cron  = new EP_Woo_WP_Cron();
        $elastic_press_class = new EP_Woo_ElasticPress();
        $wp_taxonomy_class   = new EP_Woo_WP_Taxonomy();
        $wp_meta_class       = new EP_Woo_WP_Meta();
	    $wc_product_class    = new EP_Woo_WC_Product();
		$wc_order_class      = new EP_Woo_WC_Order();
    }
}
