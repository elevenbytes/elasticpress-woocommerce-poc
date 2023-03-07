<?php
/**
 * Class related for ElasticPress plugin customizations.
 *
 * @package elbytes-ep-woo
 */

/**
 * Class related for ElasticPress plugin customizations.
 */
class EP_Woo_ElasticPress
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        add_filter( 'ep_formatted_args', [ $this, 'disable_total_products_limit' ] );
    }

    /**
     * Return more than 10.000 from ES
     *
     * @param $formatted_args
     *
     * @return mixed
     */
    public function disable_total_products_limit( $formatted_args ) {
        $formatted_args['track_total_hits'] = true;
        return $formatted_args;
    }
}
