<?php


// use Yukdiorder\Membership\ModulMembership\ModulMembership;
// use Yukdiorder\Membership\ModulDeposit\ModulDeposit;
// use Yukdiorder\Membership\ModulDropship\ModulDropship;
// use Yukdiorder\Membership\ModulStok\ModulStok;
// use Yukdiorder\Membership\ModulPointReward\ModulPointReward;
// use Yukdiorder\Membership\ModulAffiliasi\ModulAffiliasi;
//use Notice;

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://www.yukdiorder.com/
 * @since      1.0.0
 *
 * @package    Skn8_Membership
 * @subpackage Skn8_Membership/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Skn8_Membership
 * @subpackage Skn8_Membership/includes
 * @author     yukdiorder <nain.client@gmail.com>
 */
class Skn8_Membership
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Skn8_Membership_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;
	protected $modules = [];

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('SKN8_MEMBERSHIP_VERSION')) {
			$this->version = SKN8_MEMBERSHIP_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'skn8-membership';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		
		add_action('admin_menu', [$this, 'membership_menu']);
		$this->set_module(new Yukdiorder\Membership\ModulMembership\ModulMembership());
		$this->run_modules();
	}

	//  induk

	public function membership_menu()
	{
		add_menu_page('Membership', 'Membership', 'administrator', 'pluginmembership', [$this, 'view_home'], 'dashicons-groups');
		add_action('init', 'view_home');
	}

	public function enqueue()
	{

		wp_enqueue_style('enqueue', function () {
		});
	}



	public function view_home()
	{
		// require dirname(__FILE__) . '/view/halaman-depan.php';
		$current_user = wp_get_current_user();
		if (0 == $current_user->ID) {
			// Not logged in.
		} else {
			// Logged in.
		}
	}

	public function run_modules()
	{
		foreach ($this->modules as $key => $module) {
			$module->run();
		}
	}

	public function set_module($module)
	{
		array_push($this->modules, $module);
	}

	public function get_modules()
	{
		return $this->modules;
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Skn8_Membership_Loader. Orchestrates the hooks of the plugin.
	 * - Skn8_Membership_i18n. Defines internationalization functionality.
	 * - Skn8_Membership_Admin. Defines all hooks for the admin area.
	 * - Skn8_Membership_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-skn8-membership-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-skn8-membership-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-skn8-membership-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-skn8-membership-public.php';

		$this->loader = new Skn8_Membership_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Skn8_Membership_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Skn8_Membership_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Skn8_Membership_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
	}


	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Skn8_Membership_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Skn8_Membership_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}