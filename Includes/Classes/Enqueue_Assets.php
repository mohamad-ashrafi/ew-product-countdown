<?php

namespace Ew_Product_Countdown\Classes;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Enqueue_Assets {


    public static function init(): void
    {
        add_action('wp_enqueue_scripts', [__CLASS__, 'enqueue_public_assets']);
        add_action('admin_enqueue_scripts', [__CLASS__, 'enqueue_admin_assets']);
    }

    public static function enqueue_public_assets(): void
    {
        wp_enqueue_style('ew-bootstrap-css', EW_PRODUCT_COUNTDOWN_URL . 'assets/css/bootstrap.min.css', [], '');
        wp_enqueue_style('ew-glightbox-css', EW_PRODUCT_COUNTDOWN_URL . 'assets/css/glightbox.min.css', [], '');
        wp_enqueue_style('ew-gLineIcons-css', EW_PRODUCT_COUNTDOWN_URL . 'assets/css/LineIcons.3.0.css', [], '');
        wp_enqueue_style('ew-slider-css', EW_PRODUCT_COUNTDOWN_URL . 'assets/css/tiny-slider.css', [], '');
        wp_enqueue_style('ew-main-css', EW_PRODUCT_COUNTDOWN_URL . 'assets/css/main.css', [], '');
        wp_enqueue_script('ew-bootstrap-js', EW_PRODUCT_COUNTDOWN_URL . 'assets/js/bootstrap.min.js', [], '', true);
        wp_enqueue_script('ew-glightbox-js', EW_PRODUCT_COUNTDOWN_URL . 'assets/js/glightbox.min.js', [], '', true);
        wp_enqueue_script('ew-slider-js', EW_PRODUCT_COUNTDOWN_URL . 'assets/js/tiny-slider.js', [], '', true);
        wp_enqueue_script('ew-jQuery-js', EW_PRODUCT_COUNTDOWN_URL . 'assets/js/jQuery.min.js', [], '', true);
        wp_enqueue_script('ew-countdown-js', EW_PRODUCT_COUNTDOWN_URL . 'assets/js/ew-countdown-timer.js', [], '', true);
        wp_enqueue_script('ew-main-js', EW_PRODUCT_COUNTDOWN_URL . 'assets/js/main.js', [], '', true);
    }

    public static function enqueue_admin_assets(): void
    {

    }
}
