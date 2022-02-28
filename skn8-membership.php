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
 * Version:           1.0.1
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
define('SKN8_MEMBERSHIP_VERSION', '1.0.1');

require_once('vendor/autoload.php');
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/Muhwildanferdiansyah/skn8-membership',
	__FILE__,
	'skn8-membership'
);
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('master');

//Optional: If you're using a private repository, specify the access token like this:
$myUpdateChecker->setAuthentication('your-token-here');
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-development-activator.php
 */

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

	// require(ABSPATH . "/wp-admin/includes/upgrade.php");
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

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

class Employees_List_Table extends WP_List_Table
{
      private function get_users_data()
      {
            global $wpdb;

            return $wpdb->get_results(
                  "SELECT ID,user_login,user_email,display_name from {$wpdb->prefix}users",
                  ARRAY_A
            );
      }

      // Define table columns
      function get_columns()
      {
            $columns = array(
                  'cb'            => '<input type="checkbox" />',
                  'ID' => 'ID',
                  'user_login' => 'Username',
                  'display_name'    => 'Name',
                  'user_email'      => 'Email'
            );
            return $columns;
      }

      // Bind table with columns, data and all
      function prepare_items()
      {
            $columns = $this->get_columns();
            $hidden = array();
            $sortable = array();
            $this->_column_headers = array($columns, $hidden, $sortable);

            $this->items = $this->get_users_data();
      }

      // bind data with column
      function column_default($item, $column_name)
      {
            switch ($column_name) {
                  case 'ID':
                  case 'user_login':
                  case 'user_email':
                        return $item[$column_name];
                  case 'display_name':
                        return ucwords($item[$column_name]);
                  default:
                        return print_r($item, true); //Show the whole array for troubleshooting purposes
            }
      }

      function column_cb($item)
      {
            return sprintf(
                  '<input type="checkbox" name="user[]" value="%s" />',
                  $item['ID']
            );
      }

      //...
}

// Adding menu
function my_add_menu_items()
{
      add_menu_page('Employees List Table', 'Employees List Table', 'activate_plugins', 'employees_list_table', 'employees_list_init');
}
add_action('admin_menu', 'my_add_menu_items');

// Plugin menu callback function
function employees_list_init()
{
      // Creating an instance
      $empTable = new Employees_List_Table();

      echo '<div class="wrap"><h2>Employees List Table</h2>';
      // Prepare table
      $empTable->prepare_items();
      // Display table
      $empTable->display();
      echo '</div>';
}