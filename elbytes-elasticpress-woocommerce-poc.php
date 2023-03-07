<?php
/**
 * Plugin Name: ElasticPress + Woocommerce Plugin
 * Plugin URI: https://example.com/my-wordpress-plugin
 * Description: Proof of Concept for a WooCommerce shop using ElasticPress
 * Version: 1.0
 * Author: 11bytes
 * Author URI: https://11bytes.de
 * License: GPL2
 * Text Domain: elbytes-ep-woo
 *
 * @package elbytes-ep-woo
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Mail plugin class.
 */
class Elbytes_ElasticPress_Woo {

    /**
     * Constructor
     */
    public function __construct() {
        $this->constans();
        $this->init();
    }

    /**
     * Define plugin constants.
     */
    private function constans() {
        define( 'ELBYTES_EP_WOO_VERSION', '1.0.0' );
        define( 'ELBYTES_EP_WOO_NAME', 'elbytes-ep-woo' );

        // Paths.
        define( 'ELBYTES_EP_WOO_PATH', plugin_dir_path( __FILE__ ) );

        if ( ! defined( 'ELBYTES_EP_WOO_SRC_PATH' ) ) {
            define( 'ELBYTES_EP_WOO_SRC_PATH', ELBYTES_EP_WOO_PATH . 'src/' );
        }

        if ( ! defined( 'ELBYTES_EP_WOO_ASSETS_PATH' ) ) {
            define( 'ELBYTES_EP_WOO_ASSETS_PATH', ELBYTES_EP_WOO_PATH . 'assets/' );
        }
    }

    /**
     * Init main functions class.
     *
     * @return void
     */
    private function init() {
        require_once ELBYTES_EP_WOO_SRC_PATH . 'class-elastic-press-woo-init.php';

        $plugin = new EP_Woo_Init();
    }

    /**
     * Get plugin version.
     *
     * @return string
     */
    public static function get_version() {
        return ELBYTES_EP_WOO_VERSION;
    }

    /**
     * Get plugin name.
     *
     * @return string
     */
    public static function get_name() {
        return ELBYTES_EP_WOO_NAME;
    }
}

new Elbytes_ElasticPress_Woo();
