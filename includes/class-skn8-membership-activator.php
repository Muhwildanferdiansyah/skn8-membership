<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.yukdiorder.com/
 * @since      1.0.0
 *
 * @package    Skn8_Membership
 * @subpackage Skn8_Membership/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Skn8_Membership
 * @subpackage Skn8_Membership/includes
 * @author     yukdiorder <nain.client@gmail.com>
 */

class Skn8_Membership_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public static function activate()
	{
		if (version_compare(get_bloginfo('version'), '5.0', '<')) {
			wp_die("you must update wordpress to use this plugin.", 'skn8-membership');
		}
	}
}

// Checks if the WooCommerce plugins is installed and active.
