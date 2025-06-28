<?php

/**
 * Fired during plugin activation
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @subpackage Wp_Tawk_To_Integrator/includes
 * @author     ABD Prasad <contact@danukaprasad.com>
 */
class Wp_Tawk_To_Integrator_Activator
{
	/**
	 * Start from clean slate.
	 *
	 * Remove any previous plugin data if exists.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		if (get_option(WP_TAWK_TO_INTEGRATOR_OPTIONS_NAME)) {
			return;
		}

		self::set_default_options(WP_TAWK_TO_INTEGRATOR_OPTIONS_NAME);
	}

	/**
	 * Sets the default options for the plugin.
	 *
	 * This method defines the initial state of the plugin's settings
	 * and saves them to the database using the add_option function.
	 *
	 * @since 1.0.0
	 * @param string $options_key The key for the plugin's options in the database.
	 */
	public static function set_default_options()
	{
		// Define the array of default settings.
		$default_options = array(
			'property_id' => '',
			'widget_id' => '',
			'z_index' => '',
			'activate_widget' => '0',
			'pages_to_hide' => '',
			'hide_widget_admin_role' => '0',
			'hide_widget_editor_role' => '0',
			'hide_widget_author_role' => '0',
			'hide_widget_contributor_role' => '0',
			'hide_widget_subscriber_role' => '0',
			'hide_widget_customer_role' => '0',
			'show_widget_to_guest' => '1',
			'widget_maximize_element' => '',
			'auto_populate_userdata' => '0',
			'custom_attributes' => '',
			'secure_mode' => '0',
			'tawk_api_key' => '',
			'auto_page_tagging' => '0',
			'ignore_auto_tagging' => '',
			'action_based_targeting' => '0',
			'ignore_action_based_targeting' => '',
			'widget_onload_customize' => '0',
			'widget_render_delay' => '0',
			'custom_js_onload' => '',
			'chat_event_action' => '0',
			'custom_js_on_chat_started' => '',
			'custom_js_on_chat_ended' => '',
			'pre_chat_submit_action' => '0',
			'capture_pre_chat_data' => '0',
			'custom_js_on_chat_submit' => '',
		);

		// Remove option if exists
		if (get_option(WP_TAWK_TO_INTEGRATOR_OPTIONS_NAME)) {
			delete_option(WP_TAWK_TO_INTEGRATOR_OPTIONS_NAME);
		}

		// Add the option to the database.
		add_option(WP_TAWK_TO_INTEGRATOR_OPTIONS_NAME, $default_options);
	}
}
