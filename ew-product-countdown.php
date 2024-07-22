<?php
/**
 * Plugin Name: پشنهاد ویژه محصول ووکامرس
 * Description: نمایش پیشنهاد ویژه محصول ووکامرس به همراه شمارش معکوس توسط ویجت المنتور
 * Version: 1.0
 * Author: محمد اشرفی
 * Text Domain: ew-product-countdown
 * Domain Path: /languages
 */



if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('EW_PRODUCT_COUNTDOWN_PATH', plugin_dir_path(__FILE__));
define('EW_PRODUCT_COUNTDOWN_INCLUDES_PATH', plugin_dir_path(__FILE__).DIRECTORY_SEPARATOR.'includes'.DIRECTORY_SEPARATOR);
define('EW_PRODUCT_COUNTDOWN_URL', plugin_dir_url(__FILE__));


if (file_exists(EW_PRODUCT_COUNTDOWN_PATH.'vendor/autoload.php')) {
    require_once EW_PRODUCT_COUNTDOWN_PATH.'vendor/autoload.php';
}
if (file_exists(EW_PRODUCT_COUNTDOWN_PATH.'Includes/Helpers/Utilities.php')) {
    require_once EW_PRODUCT_COUNTDOWN_PATH.'Includes/Helpers/Utilities.php';
}

if (!did_action('elementor/loaded')) {
    add_action('admin_notices', function() {
        echo '<div class="notice notice-warning"><p>' . __('Elementor must be installed and activated for this plugin to work.', 'plugin-name') . '</p></div>';
    });
    return;
}

function ew_product_countdown_load_plugin(): void
{
    // Load plugin text domain for translations
    load_plugin_textdomain( 'ew-product-countdown', false, basename( dirname( __FILE__ ) ) . '/languages' );

    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'ew_product_countdown_fail_load' );
        return;
    }

    $core_version = ELEMENTOR_VERSION;
    $core_version_required = '3.23.1';
    $core_version_recommended = '3.23.1';
    if ( version_compare( $core_version, $core_version_required, '<' ) ) {
        add_action( 'admin_notices', 'ew_product_countdown_fail_load_out_of_date' );
        return;
    }
    if ( version_compare( $core_version, $core_version_recommended, '<' ) ) {
        add_action( 'admin_notices', 'ew_product_countdown_admin_notice_upgrade_recommendation' );
    }
    require plugin_dir_path( __FILE__ ) . 'includes/plugin.php';
}
add_action( 'plugins_loaded', 'ew_product_countdown_load_plugin' );

function ew_product_countdown_fail_load(): void
{
    echo '<div class="error"><p>' . esc_html__( 'My Elementor Addon requires Elementor to be installed and activated.', 'ew-product-countdown' ) . '</p></div>';
}

function ew_product_countdown_fail_load_out_of_date(): void
{
    echo '<div class="error"><p>' . esc_html__( 'My Elementor Addon requires Elementor version 3.23.1 or greater.', 'ew-product-countdown' ) . '</p></div>';
}

function ew_product_countdown_admin_notice_upgrade_recommendation(): void
{
    echo '<div class="error"><p>' . esc_html__( 'For best performance, it is recommended to update Elementor to the latest version.', 'ew-product-countdown' ) . '</p></div>';
}



function ew_product_countdown_init(): void
{
    Ew_Product_Countdown\Classes\Enqueue_Assets::init();
    Ew_Product_Countdown\Classes\Widget_Manager::instance();
    Ew_Product_Countdown\Maintenance::init();

}
add_action('plugins_loaded', 'ew_product_countdown_init');




add_action('wp_ajax_load_products_by_category', 'load_products_by_category');
add_action('wp_ajax_nopriv_load_products_by_category', 'load_products_by_category');

function load_products_by_category()
{
    $category_id = intval($_POST['category_id']);
    $products = wc_get_products([
        'status' => 'publish',
        'limit' => -1,
        'category' => [$category_id],
        'meta_query' => [
            [
                'key' => '_sale_price',
                'value' => '',
                'compare' => '!=',
            ],
        ],
    ]);

    $product_options = [];
    foreach ($products as $product) {
        $product_options[$product->get_id()] = $product->get_name();
    }

    echo json_encode($product_options);
    wp_die();
}

