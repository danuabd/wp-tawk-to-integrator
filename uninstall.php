<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 */

// If uninstall not called from WordPress, then exit.
if (! defined('WP_UNINSTALL_PLUGIN')) {
	exit;
}

// Delete the main plugin options.
delete_option(WP_TAWK_TO_INTEGRATOR_OPTIONS_NAME);
