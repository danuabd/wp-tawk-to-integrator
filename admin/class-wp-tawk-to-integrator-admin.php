<?php

/**
 * The admin-specific functionality of the plugin.
 * 
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @subpackage Wp_Tawk_To_Integrator/admin
 * @author     ABD Prasad <contact@danukaprasad.com>
 */
class Wp_Tawk_To_Integrator_Admin
{

	/**
	 * The plugin name of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The plugin name of this plugin.
	 */
	private $plugin_name;

	/**
	 * The plugin version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_version    The plugin version of this plugin.
	 */
	private $plugin_version;

	/**
	 * The hook suffix for the settings page.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string
	 */
	private $settings_page_hook_suffix;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      array    $plugin_meta       The meta data of this plugin.
	 */
	public function __construct($plugin_meta)
	{

		$this->plugin_name = $plugin_meta['name'];
		$this->plugin_version = $plugin_meta['version'];
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 * @param    string $hook_suffix The hook suffix for the current admin page.
	 */
	public function enqueue_styles($hook_suffix)
	{
		// 1. Only load styles in plugin admin settings page
		if ($hook_suffix !== $this->settings_page_hook_suffix) {
			return;
		}

		// Enqueue material icons CSS
		wp_enqueue_style(
			$this->plugin_name . 'material-icons',
			"https://fonts.googleapis.com/icon?family=Material+Icons+Outlined",
			array(),
			$this->plugin_version

		);

		// Enqueue admin settings CSS
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wp-tawk-to-integrator-admin.css', array(), filemtime(plugin_dir_path(__FILE__) . 'css/wp-tawk-to-integrator-admin.css'));
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook_suffix)
	{
		// 1. Only load scripts in plugin admin settings page
		if ($hook_suffix !== $this->settings_page_hook_suffix) {
			return;
		}

		// Enqueue admin settings JS
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wp-tawk-to-integrator-admin.js', array(), filemtime(plugin_dir_path(__FILE__) . 'js/wp-tawk-to-integrator-admin.js'), true);
	}


	/**
	 * Redirect to settings page after activation.
	 *
	 * @since    1.0.0
	 */
	public function redirect_on_activation()
	{

		if (get_transient('wpti_redirect_on_activation')) {
			// Delete the transient so this only runs once.
			delete_transient('wpti_redirect_on_activation');

			// Build the redirect URL using the plugin_name property from the class.
			$redirect_url = admin_url('admin.php?page=' . $this->plugin_name . '-settings');

			// Perform the safe redirect.
			wp_safe_redirect($redirect_url);
			exit;
		}
	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_admin_menu()
	{
		$this->settings_page_hook_suffix = add_menu_page(
			__('Configure Tawk.to Chat Widget', 'wp-tawk-to-integrator'), // Page Title
			__('WP Tawk.to Integrator', 'wp-tawk-to-integrator'), // Menu Title
			'manage_options',                               // Capability
			$this->plugin_name . '-settings',               // Menu Slug
			array($this, 'display_settings_page'),        // Callback function
			'dashicons-format-chat', // Icon
			99
		);
	}


	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_settings_page()
	{
		// Check if the user has permissions to access this page
		if (! current_user_can('manage_options')) {
			return;
		}
		// Include the settings page view
		require_once plugin_dir_path(__FILE__) . 'partials/wp-tawk-to-integrator-admin-display.php';
	}

	/**
	 * Register the settings for this plugin.
	 *
	 * @since 1.0.0
	 */
	public function register_settings()
	{
		register_setting(
			WP_TAWK_TO_INTEGRATOR_OPTIONS_GROUP_NAME, // Option group
			WP_TAWK_TO_INTEGRATOR_OPTIONS_NAME,       // Option name
			array($this, 'sanitize_options')     // Sanitize callback
		);
	}

	/**
	 * Sanitize each setting field as needed.
	 *
	 * @since 1.0.0
	 * @param array $input Contains all settings fields as array keys
	 * @return array Sanitized array of options
	 */
	public function sanitize_options($input)
	{
		// Create a new array to store our sanitized options
		$sanitized_value = array();

		// --- Integration Tab ---
		if (isset($input['property_id'])) {
			$sanitized_value['property_id'] = sanitize_text_field($input['property_id']);
		}
		if (isset($input['widget_id'])) {
			$sanitized_value['widget_id'] = sanitize_text_field($input['widget_id']);
		}
		// absint ensures we get an absolute integer.
		if (isset($input['z_index'])) {
			$sanitized_value['z_index'] = absint($input['z_index']);
		}
		// For checkboxes/toggles, we check if they exist and save a 1 (for 'on') or 0 (for 'off').
		$sanitized_value['activate_widget'] = (isset($input['activate_widget'])) ? 1 : 0;


		// --- Appearance Tab ---
		if (isset($input['pages_to_hide'])) {
			$sanitized_value['pages_to_hide'] = sanitize_text_field($input['pages_to_hide']);
		}
		$sanitized_value['show_widget_to_guest'] = (isset($input['show_widget_to_guest'])) ? 1 : 0;
		// Example for the role toggles
		$roles_to_hide = ['administrator', 'editor', 'author', 'contributor', 'subscriber', 'customer'];
		foreach ($roles_to_hide as $role) {
			$key = 'hide_widget_' . $role . '_role_check';
			$sanitized_value[$key] = (isset($input[$key])) ? 1 : 0;
		}


		// --- Behavior Tab ---
		if (isset($input['widget_maximize_element'])) {
			$sanitized_value['widget_maximize_element'] = sanitize_text_field($input['widget_maximize_element']);
		}
		$sanitized_value['auto_populate_userdata'] = (isset($input['auto_populate_userdata'])) ? 1 : 0;
		if (isset($input['custom_attributes'])) {
			$sanitized_value['custom_attributes'] = sanitize_text_field($input['custom_attributes']);
		}
		$sanitized_value['secure_mode'] = (isset($input['secure_mode'])) ? 1 : 0;
		if (isset($input['tawk_api_key'])) {
			// API keys can have special characters, so we just trim whitespace.
			$sanitized_value['tawk_api_key'] = trim($input['tawk_api_key']);
		}

		// --- Events Tab ---
		$sanitized_value['auto_page_tagging'] = (isset($input['auto_page_tagging'])) ? 1 : 0;
		if (isset($input['ignore_auto_tagging'])) {
			$sanitized_value['ignore_auto_tagging'] = sanitize_text_field($input['ignore_auto_tagging']);
		}

		$sanitized_value['action_based_targeting'] = (isset($input['action_based_targeting'])) ? 1 : 0;
		if (isset($input['ignore_action_based_targeting'])) {
			$sanitized_value['ignore_action_based_targeting'] = sanitize_text_field($input['ignore_action_based_targeting']);
		}

		$sanitized_value['widget_onload_customize'] = (isset($input['widget_onload_customize'])) ? 1 : 0;
		if (isset($input['widget_render_delay'])) {
			$sanitized_value['widget_render_delay'] = absint($input['widget_render_delay']);
		}
		if (isset($input['custom_js_onload'])) {
			$sanitized_value['custom_js_onload'] = trim($input['custom_js_onload']);
		}

		$sanitized_value['chat_event_action'] = (isset($input['chat_event_action'])) ? 1 : 0;
		if (isset($input['custom_js_on_chat_started'])) {
			$sanitized_value['custom_js_on_chat_started'] = trim($input['custom_js_on_chat_started']);
		}
		if (isset($input['custom_js_on_chat_ended'])) {
			$sanitized_value['custom_js_on_chat_ended'] = trim($input['custom_js_on_chat_ended']);
		}

		$sanitized_value['pre_chat_submit_action'] = (isset($input['pre_chat_submit_action'])) ? 1 : 0;
		$sanitized_value['capture_pre_chat_data'] = (isset($input['capture_pre_chat_data'])) ? 1 : 0;
		if (isset($input['custom_js_on_chat_submit'])) {
			$sanitized_value['custom_js_on_chat_submit'] = trim($input['custom_js_on_chat_submit']);
		}


		return $sanitized_value;
	}

	/**
	 * Reset the settings for this plugin.
	 *
	 * @since 1.0.0
	 */
	function handle_plugin_reset()
	{
		if (
			isset($_GET['plugin'], $_GET['action']) &&
			$_GET['plugin'] === $this->plugin_name &&
			$_GET['action'] === 'reset' &&
			check_admin_referer('reset_plugin_settings')
		) {

			if (! class_exists('Plugin_Name_Activator')) {
				require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-' . $this->plugin_name . '-activator.php';
			}

			// Add default options
			Wp_Tawk_To_Integrator_Activator::set_default_options();

			// Optional: Add an admin notice (temporary)
			add_action('admin_notices', function () {
				echo '<div class="notice notice-success is-dismissible"><p>Plugin settings have been reset.</p></div>';
			});
		}
	}
}
