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
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
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
			$this->version

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
			$this->plugin_name . '_options_group', // Option group
			$this->plugin_name . '_options',       // Option name
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
		$sanitized_input = array();

		// --- Integration Tab ---
		if (isset($input['property_id_input'])) {
			$sanitized_input['property_id_input'] = sanitize_text_field($input['property_id_input']);
		}
		if (isset($input['widget_id_input'])) {
			$sanitized_input['widget_id_input'] = sanitize_text_field($input['widget_id_input']);
		}
		// absint ensures we get an absolute integer.
		if (isset($input['z_index_input'])) {
			$sanitized_input['z_index_input'] = absint($input['z_index_input']);
		}
		// For checkboxes/toggles, we check if they exist and save a 1 (for 'on') or 0 (for 'off').
		$sanitized_input['activate_widget_check'] = (isset($input['activate_widget_check'])) ? 1 : 0;


		// --- Appearance Tab ---
		if (isset($input['pages_to_hide_input'])) {
			$sanitized_input['pages_to_hide_input'] = sanitize_text_field($input['pages_to_hide_input']);
		}
		$sanitized_input['show_widget_to_guest'] = (isset($input['show_widget_to_guest'])) ? 1 : 0;
		// Example for the role toggles
		$roles_to_hide = ['administrator', 'editor', 'author', 'contributor', 'subscriber', 'customer'];
		foreach ($roles_to_hide as $role) {
			$key = 'hide_widget_' . $role . '_role_check';
			$sanitized_input[$key] = (isset($input[$key])) ? 1 : 0;
		}


		// --- Behavior Tab ---
		if (isset($input['widget_maximize_element_input'])) {
			$sanitized_input['widget_maximize_element_input'] = sanitize_text_field($input['widget_maximize_element_input']);
		}
		$sanitized_input['auto_populate_userdata_check'] = (isset($input['auto_populate_userdata_check'])) ? 1 : 0;
		if (isset($input['custom_attributes_input'])) {
			$sanitized_input['custom_attributes_input'] = sanitize_text_field($input['custom_attributes_input']);
		}
		$sanitized_input['secure_mode_check'] = (isset($input['secure_mode_check'])) ? 1 : 0;
		if (isset($input['tawk_api_key_input'])) {
			// API keys can have special characters, so we just trim whitespace.
			$sanitized_input['tawk_api_key_input'] = trim($input['tawk_api_key_input']);
		}

		// --- Events Tab ---
		$sanitized_input['auto_page_tagging_check'] = (isset($input['auto_page_tagging_check'])) ? 1 : 0;
		if (isset($input['ignore_auto_tagging_input'])) {
			$sanitized_input['ignore_auto_tagging_input'] = sanitize_text_field($input['ignore_auto_tagging_input']);
		}

		$sanitized_input['action_based_targeting_check'] = (isset($input['action_based_targeting_check'])) ? 1 : 0;
		if (isset($input['ignore_action_based_targeting_input'])) {
			$sanitized_input['ignore_action_based_targeting_input'] = sanitize_text_field($input['ignore_action_based_targeting_input']);
		}

		$sanitized_input['widget_onload_customize_check'] = (isset($input['widget_onload_customize_check'])) ? 1 : 0;
		if (isset($input['widget_render_delay_input'])) {
			$sanitized_input['widget_render_delay_input'] = absint($input['widget_render_delay_input']);
		}
		if (isset($input['custom_js_onload'])) {
			$sanitized_input['custom_js_onload'] = trim($input['custom_js_onload']);
		}

		$sanitized_input['chat_event_action_check'] = (isset($input['chat_event_action_check'])) ? 1 : 0;
		if (isset($input['custom_js_on_chat_started'])) {
			$sanitized_input['custom_js_on_chat_started'] = trim($input['custom_js_on_chat_started']);
		}
		if (isset($input['custom_js_on_chat_ended_input'])) {
			$sanitized_input['custom_js_on_chat_ended_input'] = trim($input['custom_js_on_chat_ended_input']);
		}

		$sanitized_input['pre_chat_submit_action_check'] = (isset($input['pre_chat_submit_action_check'])) ? 1 : 0;
		$sanitized_input['capture_pre_chat_data_check'] = (isset($input['capture_pre_chat_data_check'])) ? 1 : 0;
		if (isset($input['custom_js_on_chat_submit_input'])) {
			$sanitized_input['custom_js_on_chat_submit_input'] = trim($input['custom_js_on_chat_submit_input']);
		}


		return $sanitized_input;
	}
}
