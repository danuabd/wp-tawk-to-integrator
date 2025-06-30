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
	public static function activate($option_name, $default_option)
	{
		if (get_option($option_name)) {
			return;
		}

		self::set_default_options($option_name, $default_option);
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
	public static function set_default_options($option_name, $default_option)
	{

		// Remove option if exists
		if (get_option($option_name)) {
			delete_option($option_name);
		}

		// Add the option to the database.
		update_option($option_name, $default_option);
	}
}
