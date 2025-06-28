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

/**
 * Get config class
 */
require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator-config.php';

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
		if (get_option(Wp_Tawk_To_Integrator_Config::get_option_name())) {
			return;
		}

		self::set_default_options(Wp_Tawk_To_Integrator_Config::get_option_name());
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

		// Remove option if exists
		if (get_option(Wp_Tawk_To_Integrator_Config::get_option_name())) {
			delete_option(Wp_Tawk_To_Integrator_Config::get_option_name());
		}

		// Add the option to the database.
		add_option(Wp_Tawk_To_Integrator_Config::get_option_name(), Wp_Tawk_To_Integrator_Config::get_default_options());
	}
}
