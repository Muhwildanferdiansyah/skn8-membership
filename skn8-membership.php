<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.yukdiorder.com/
 * @since             1.0.0
 * @package           Skn8_Membership
 *
 * @wordpress-plugin
 * Plugin Name:       skn8 membership
 * Plugin URI:        https://www.yukdiorder.com/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            yukdiorder
 * Author URI:        https://www.yukdiorder.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       skn8-membership
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}



/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SKN8_MEMBERSHIP_VERSION', '1.0.0');

require_once('vendor/autoload.php');

//Tool Notice 
if (!class_exists('Notice')) {

	class Notice
	{

		public function __construct($pesan)
		{
			add_action('admin_notices', function () use ($pesan) {
?>
				<div class="notice notice-success is-dismissible">
					<p><?php echo $pesan; ?></p>
				</div>
<?php
			});
		}
	}
}




/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-skn8-membership-activator.php
 */
function activate_skn8_membership()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-skn8-membership-activator.php';
	Skn8_Membership_Activator::activate();

	// global $wpdb;
	// $createSQL	= "
	// 	CREATE TABLE `" . $wpdb->prefix . "data` (
	// 		`ID` INT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
	// 		`nama` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	// 		`alamat` VARCHAR(50) NOT NULL COLLATE 'latin1_swedish_ci',
	// 		PRIMARY KEY (`ID`) USING BTREE
	// 	)ENGINE=InnoDB;" . $wpdb->get_charset_collate() . ";";

	// // require(ABSPATH . "/wp-admin/includes/upgrade.php");
	// dbDelta($createSQL);

	// $wpdb->insert($wpdb->prefix . 'data', array(
	// 	// 'id' => null,
	// 	'nama' => 'wildan',
	// 	'alamat' => 'malang'
	// ));
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-skn8-membership-deactivator.php
 */
function deactivate_skn8_membership()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-skn8-membership-deactivator.php';
	Skn8_Membership_Deactivator::deactivate();
}
//hook 
register_activation_hook(__FILE__, 'activate_skn8_membership');
register_deactivation_hook(__FILE__, 'deactivate_skn8_membership');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-skn8-membership.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_skn8_membership()
{

	$plugin = new Skn8_Membership();
	$plugin->run();
}


run_skn8_membership();


// define the wc_add_to_cart_message_html callback 
// function filter_wc_add_to_cart_message_html($message, $products)
// {
// 	$message = 'item di lebokno nang keranjang';
// 	return $message;
// };

// add the filter 
// add_filter('wc_add_to_cart_message_html', 'filter_wc_add_to_cart_message_html', 10, 2);

// function filter_woocommerce_product_variation_title($rtrim, $product, $title_base, $title_suffix)
// {
// 	$rtrim = 'halo';
// 	return $rtrim;
// };

// add the filter 
// add_filter('woocommerce_product_variation_title', 'filter_woocommerce_product_variation_title', 10, 4);


// function filter_woocommerce_cart_product_price($wc_price, $product)
// {
// 	$wc_price = $wc_price + 10000;
// 	return $wc_price;
// };
// add the filter 
// add_filter('woocommerce_cart_product_price', 'filter_woocommerce_cart_product_price', 10, 2);

// add_filter('storefront_footer_widget_columns', function ($column) {
// 	$column = 10;
// 	return $column;
// });

//add action 

// $daftar_hook = array(
// 	'woocommerce_before_single_product',
// 	'woocommerce_before_variations_form',
// 	'woocommerce_before_single_variation',
// 	'woocommerce_single_variation',
// 	'woocommerce_after_single_variation',
// 	'woocommerce_after_variations_form',
// 	'woocommerce_product_meta_start',
// 	'woocommerce_product_meta_end',
// 	'woocommerce_share',
// 	'woocommerce_after_single_product_summary',
// 	'woocommerce_after_single_product',
// 	// keranjang
// 	'woocommerce_after_add_to_cart_form',
// 	'woocommerce_before_add_to_cart_quantity',
// 	'woocommerce_after_add_to_cart_quantity',
// 	'woocommerce_after_add_to_cart_button',
// 	'woocommerce_before_cart',
// 	'woocommerce_before_cart_table',
// 	'woocommerce_before_cart_contents',
// 	'woocommerce_cart_contents',
// 	'woocommerce_after_cart_contents',
// 	'woocommerce_cart_is_empty',
// 	'woocommerce_cart_totals_before_shipping',
// 	'woocommerce_cart_totals_after_shipping',
// 	'woocommerce_cart_totals_before_order_total',
// 	'woocommerce_cart_totals_after_order_total',

// 	//checkout
// 	'woocommerce_before_checkout_form',
// 	'woocommerce_checkout_before_customer_details',
// 	'woocommerce_before_checkout_billing_form',
// 	'woocommerce_checkout_shipping',
// 	'woocommerce_checkout_after_order_review',
// 	'woocommerce_checkout_after_customer_details',
// 	'woocommerce_checkout_before_order_review',
// 	'woocommerce_review_order_before_cart_contents',
// 	// Before content
// 	'woocommerce_before_main_content',
// 	'woocommerce_sidebar',
// 	//Left column
// 	'woocommerce_before_single_product_summary',
// 	// Right column
// 	'woocommerce_single_product_summary',
// 	// Right column - add to cart
// 	'woocommerce_before_add_to_cart_form',
// 	'woocommerce_before_add_to_cart_button',
// 	// Reviews
// 	'woocommerce_review_before',
// 	'woocommerce_review_display_gravatar',
// 	'woocommerce_review_before_comment_meta',
// 	'woocommerce_review_display_rating',
// 	'woocommerce_review_meta',
// 	'woocommerce_review_display_meta',
// 	'woocommerce_review_before_comment_text',
// 	'woocommerce_review_comment_text',
// 	'woocommerce_review_display_comment_text',
// 	'woocommerce_review_after_comment_text',
// 	// After content
// 	'woocommerce_after_single_product',
// 	'woocommerce_after_main_content',
// 	'woocommerce_archive_description',
// 	//shop
// 	'woocommerce_before_shop_loop',
// 	'woocommerce_before_shop_loop_item',
// 	'woocommerce_before_shop_loop_item_title',
// 	'woocommerce_shop_loop_item_title',
// 	'woocommerce_after_shop_loop_item_title',
// 	'woocommerce_after_shop_loop_item',
// 	'woocommerce_after_shop_loop',
// 	//myaccount
// 	'woocommerce_before_customer_login_form',
// 	'woocommerce_login_form_start',
// 	'woocommerce_register_form_start',
// 	'woocommerce_login_form',
// 	'woocommerce_register_form',
// 	'register_form',
// 	'woocommerce_login_form_end',
// 	'woocommerce_register_form_end',
// 	'woocommerce_after_customer_login_form',
// 	'woocommerce_account_navigation',
// 	'woocommerce_before_account_navigation',
// 	'woocommerce_account_content',
// 	'woocommerce_account_dashboard',
// 	'woocommerce_after_account_navigation',
// 	//order
// 	'woocommerce_before_account_orders (param: $has_orders)',
// 	'woocommerce_before_account_orders_pagination',
// 	'woocommerce_after_account_orders (param: $has_orders)',
// 	//download
// 	'woocommerce_before_account_downloads (param: $has_downloads)',
// 	'woocommerce_before_available_downloads',
// 	'woocommerce_after_available_downloads',
// 	'woocommerce_after_account_downloads',
// 	//address
// 	'woocommerce_before_edit_account_address_form',
// 	'woocommerce_after_edit_account_address_form',
// 	'woocommerce_before_edit_address_form_{$load_address}',
// 	'woocommerce_after_edit_address_form_{$load_address}',
// 	//payment metdod
// 	'woocommerce_before_account_payment_methods (param: $has_methods)',
// 	'woocommerce_after_account_payment_methods (param: $has_methods)',
// 	'woocommerce_before_edit_account_form',
// 	'woocommerce_edit_account_form_start',
// 	'woocommerce_edit_account_form',
// 	'woocommerce_edit_account_form_end'

// );

// foreach ($daftar_hook as $hook) {
// 	global $hook;
// 	add_action($hook, function () use ($hook) {
// 		echo "<span style= 'color:red'>" . $hook . "</span>";
// 	});
// }

// use Automattic\WooCommerce\Client;

// $woocommerce = new Client(
// 	'http://webprograming.devv/',
// 	'ck_733a7a3adafac84a734c0b352b32c7f5214c4534',
// 	'cs_2bfea8ee07656383852802481b4af289fcfebe51',
// 	[
// 		'version' => 'wc/v3',
// 	]
// );

// $endpoint = 'wp-json/wc/v3/customers';
// $woocommerce->get($endpoint, $parameters = []) ;

// $store_url = 'http://webprograming.devv/';
// $endpoint = '/wc-auth/v1/authorize';
// $params = [
// 	'app_name' => 'webprograming.devv',
// 	'scope' => 'write',
// 	'user_id' => 1,
// 	'return_url' => 'http://webprograming.devv',
// 	'callback_url' => 'https://webprograming.devv'
// ];
// $query_string = http_build_query($params);

// echo $store_url . $endpoint . '?' . $query_string;
