<?php

/**
 * The file that defines the core plugin class
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 * 
 * Also maintains the unique identifier of this plugin as well as the current version of the plugin.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @subpackage Wp_Tawk_To_Integrator/includes
 * @author     ABD Prasad <contact@danukaprasad.com>
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
class Wp_Tawk_To_Integrator
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wp_Tawk_To_Integrator_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The meta data of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      array    $plugin_meta    The meta data of the plugin.
	 */
	protected $plugin_meta;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct($plugin_meta)
	{

		$this->plugin_meta = $plugin_meta;

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wp_Tawk_To_Integrator_Loader. Orchestrates the hooks of the plugin.
	 * - Wp_Tawk_To_Integrator_i18n. Defines internationalization functionality.
	 * - Wp_Tawk_To_Integrator_Admin. Defines all hooks for the admin area.
	 * - Wp_Tawk_To_Integrator_Public. Defines all hooks for the public side of the site.
	 *
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		$plugin_path = $this->plugin_meta['plugin_path'];

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once $plugin_path . 'includes/class-wp-tawk-to-integrator-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once $plugin_path . 'includes/class-wp-tawk-to-integrator-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once $plugin_path . 'admin/class-wp-tawk-to-integrator-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once $plugin_path . 'public/class-wp-tawk-to-integrator-public.php';

		$this->loader = new Wp_Tawk_To_Integrator_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wp_Tawk_To_Integrator_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Wp_Tawk_To_Integrator_i18n();

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

		$plugin_admin = new Wp_Tawk_To_Integrator_Admin($this->plugin_meta);

		$this->loader->add_action('admin_init', $plugin_admin, 'redirect_on_activation');

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		$this->loader->add_action('admin_menu', $plugin_admin, 'add_admin_menu');
		$this->loader->add_action('admin_init', $plugin_admin, 'register_settings');

		$this->loader->add_action('admin_init', $plugin_admin, 'handle_plugin_reset');
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
		$plugin_name = $this->plugin_meta['plugin_name'];
		$option_name = $this->plugin_meta['option_name'];

		$plugin_public = new Wp_Tawk_To_Integrator_Public($plugin_name, $option_name);

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles', 99999);
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		$this->loader->add_action('wp_footer', $plugin_public, 'embed_tawk_to_widget');
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
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wp_Tawk_To_Integrator_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}
}
