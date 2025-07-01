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

// Include the configuration class to access the option name. This is necessary to ensure we delete the correct option.
if (! class_exists('Wp_Tawk_To_Integrator_Config')) {
	include_once plugin_dir_path(__FILE__) . 'class-wp-tawk-to-integrator-config.php';
}


// Delete the main plugin options.
delete_option(Wp_Tawk_To_Integrator_Config::$option_name);
