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
	 */
	public function enqueue_styles()
	{

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
	public function enqueue_scripts()
	{

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
		add_menu_page(
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
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/partials/settings-page.php';
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
		if (isset($input['property-id'])) {
			$sanitized_input['property-id'] = sanitize_text_field($input['property-id']);
		}
		if (isset($input['widget-id'])) {
			$sanitized_input['widget-id'] = sanitize_text_field($input['widget-id']);
		}
		// absint ensures we get an absolute integer.
		if (isset($input['z-index'])) {
			$sanitized_input['z-index'] = absint($input['z-index']);
		}
		// For checkboxes/toggles, we check if they exist and save a 1 (for 'on') or 0 (for 'off').
		$sanitized_input['activate-widget'] = (isset($input['activate-widget'])) ? 1 : 0;


		// --- Appearance Tab ---
		if (isset($input['page-ids-to-hide'])) {
			$sanitized_input['page-ids-to-hide'] = sanitize_text_field($input['page-ids-to-hide']);
		}
		$sanitized_input['show-widget-for-guests'] = (isset($input['show-widget-for-guests'])) ? 1 : 0;
		// Example for the role toggles
		$roles_to_hide = ['administrator', 'editor', 'author', 'contributor', 'subscriber', 'customer'];
		foreach ($roles_to_hide as $role) {
			$key = 'hide-for-' . $role . '-role';
			$sanitized_input[$key] = (isset($input[$key])) ? 1 : 0;
		}


		// --- Behavior Tab ---
		if (isset($input['maximize-on-element-click'])) {
			$sanitized_input['maximize-on-element-click'] = sanitize_text_field($input['maximize-on-element-click']);
		}
		$sanitized_input['auto-populate-user-data'] = (isset($input['auto-populate-user-data'])) ? 1 : 0;
		if (isset($input['custom-attributes'])) {
			$sanitized_input['custom-attributes'] = sanitize_text_field($input['custom-attributes']);
		}
		$sanitized_input['enable-secure-mode'] = (isset($input['enable-secure-mode'])) ? 1 : 0;
		if (isset($input['tawk-api-key'])) {
			// API keys can have special characters, so we just trim whitespace.
			$sanitized_input['tawk-api-key'] = trim($input['tawk-api-key']);
		}

		// --- Events Tab ---
		$sanitized_input['enable-auto-page-tagging'] = (isset($input['enable-auto-page-tagging'])) ? 1 : 0;
		if (isset($input['pages-to-ignore-auto-tagging'])) {
			$sanitized_input['pages-to-ignore-auto-tagging'] = sanitize_text_field($input['pages-to-ignore-auto-tagging']);
		}

		$sanitized_input['enable-action-based-targeting'] = (isset($input['enable-action-based-targeting'])) ? 1 : 0;
		if (isset($input['pages-to-ignore-action-based-targeting'])) {
			$sanitized_input['pages-to-ignore-action-based-targeting'] = sanitize_text_field($input['pages-to-ignore-action-based-targeting']);
		}

		$sanitized_input['enable-onload-customization'] = (isset($input['enable-onload-customization'])) ? 1 : 0;
		if (isset($input['widget-load-delay-time'])) {
			$sanitized_input['widget-load-delay-time'] = absint($input['widget-load-delay-time']);
		}
		if (isset($input['custom-js-onload'])) {
			// Using wp_kses_post to allow some HTML/script tags but prevent malicious code.
			// For raw JS, you might just use trim(), but this is safer.
			$sanitized_input['custom-js-onload'] = wp_kses_post($input['custom-js-onload']);
		}

		$sanitized_input['enable-chat-event-action'] = (isset($input['enable-chat-event-action'])) ? 1 : 0;
		if (isset($input['custom-js-onchatstarted'])) {
			$sanitized_input['custom-js-onchatstarted'] = wp_kses_post($input['custom-js-onchatstarted']);
		}
		if (isset($input['custom-js-onchatended'])) {
			$sanitized_input['custom-js-onchatended'] = wp_kses_post($input['custom-js-onchatended']);
		}

		$sanitized_input['enable-prechat-submit-actions-toggle'] = (isset($input['enable-prechat-submit-actions-toggle'])) ? 1 : 0;
		$sanitized_input['capture-prechat-data'] = (isset($input['capture-prechat-data'])) ? 1 : 0;
		if (isset($input['custom-js-onprechatsubmit'])) {
			$sanitized_input['custom-js-onprechatsubmit'] = wp_kses_post($input['custom-js-onprechatsubmit']);
		}


		return $sanitized_input;
	}
}
