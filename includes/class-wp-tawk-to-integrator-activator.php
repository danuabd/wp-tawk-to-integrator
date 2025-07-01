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
		// Check for any previous plugin data.
		if (get_option($option_name)) {
			return;
		}

		// Add default option (first time).
		update_option($option_name, $default_option);
	}
}
