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

include_once plugin_dir_path(__FILE__) . 'includes/class-wp-tawk-to-integrator-config.php';

// Delete the main plugin options.
delete_option(Wp_Tawk_To_Integrator_Config::get_all()['option_name']);
