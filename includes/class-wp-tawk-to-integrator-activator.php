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
	private $options_key;

	/**
	 * Start from clean slate.
	 *
	 * Remove any previous plugin data if exists.
	 *
	 * @since    1.0.0
	 */
	public static function activate($options_key)
	{
		if ($options_key) {
			delete_option($options_key);
		}

		self::set_default_options($options_key);
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
	public static function set_default_options($options_key)
	{
		// Define the array of default settings.
		$default_options = array(
			'property-id' => '',
			'widget-id]' => '',
			'z-index' => '',
			'page-ids-to-hide' => '',
			'hide-for-administrator-role' => '',
			'hide-for-editor-role' => '',
			'hide-for-author-role' => '',
			'hide-for-contributor-role' => '',
			'hide-for-subscriber-role' => '',
			'hide-for-customer-role' => '',
			'show-widget-for-guests' => '1',
			'maximize-on-element-click' => '',
			'auto-populate-user-data' => '',
			'custom-attributes' => '',
			'enable-secure-mode' => '',
			'tawk-api-key' => '',
			'enable-auto-page-tagging' => '',
			'pages-to-ignore-auto-tagging' => '',
			'enable-action-based-targeting' => '',
			'pages-to-ignore-action-based-targeting' => '',
			'enable-onload-customization' => '',
			'widget-load-delay-time' => '',
			'custom-js-onload' => '',
			'enable-chat-event-action' => '',
			'custom-js-onchatstarted' => '',
			'custom-js-onchatended' => '',
			'enable-prechat-submit-actions' => '',
			'capture-prechat-data' => '',
			'custom-js-onprechatsubmit' => '',
		);

		// Add the option to the database.
		add_option($options_key, $default_options);
	}
}
