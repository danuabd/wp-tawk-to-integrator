<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    WP_Tawk_To_Integrator
 * @subpackage WP_Tawk_To_Integrator/admin
 */

if (! defined('WPINC')) {
    die;
}

class WP_Tawk_To_Integrator_Admin
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
     * @param    string    $plugin_name       The name of this plugin.
     * @param    string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
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
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/views/settings-page.php';
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
        // (Sanitization logic for Events tab fields would go here)


        return $sanitized_input;
    }

    /**
     * Register the stylesheets and scripts for the admin settings page.
     *
     * @since    1.0.0
     * @param    string    $hook_suffix    The current admin page.
     */
    public function enqueue_styles_and_scripts($hook_suffix)
    {

        // Define the correct hook suffix for settings page.
        $plugin_page_hook = 'toplevel_page_' . $this->plugin_name . '-settings';

        // Check if the current page is plugin's settings page.
        // Prevent styles from loading everywhere.
        if ($hook_suffix !== $plugin_page_hook) {
            return;
        }


        // Enqueue admin settings CSS
        wp_enqueue_style(
            $this->plugin_name . '-prebuilt-admin-styles',
            plugin_dir_url(__FILE__) . 'assets/css/settings.css',
            array(),
            filemtime(plugin_dir_path(__FILE__) . 'assets/css/settings.css')
        );


        // Enqueue material icons CSS
        wp_enqueue_style(
            $this->plugin_name . 'material-icons',
            "https://fonts.googleapis.com/icon?family=Material+Icons+Outlined",
            array(),
            $this->version
        );

        // Enqueue admin settings JS
        wp_enqueue_script(
            $this->plugin_name . '-admin-scripts',
            plugin_dir_url(__FILE__) . 'assets/js/settings.js',
            array(),
            filemtime(plugin_dir_path(__FILE__) . 'assets/js/settings.js'),
            true
        );
    }
}
