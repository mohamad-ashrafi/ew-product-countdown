<?php

namespace Ew_Product_Countdown\Widgets;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

abstract class WoocommerceProductCountdownBase extends \Elementor\Widget_Base
{
    abstract protected function render_template($settings, $product, $countdown_time, $countdown_days, $countdown_hours, $countdown_minutes, $countdown_seconds);

    protected function get_woocommerce_products_by_category_and_sale($category_id): array
    {
        $args = [
            'status' => 'publish',
            'limit' => -1,
            'category' => [(string) $category_id],
            'meta_query' => [
                [
                    'key' => '_sale_price',
                    'value' => '',
                    'compare' => '!=',
                ],
            ],
        ];
        $products = wc_get_products($args);
        $product_options = [];

        foreach ($products as $product) {
            $product_options[$product->get_id()] = $product->get_name();
        }

        return $product_options;
    }
}
