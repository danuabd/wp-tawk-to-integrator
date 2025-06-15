<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://danukaprasad.com
 * @since             1.0.0
 * @package           Wp_Tawk_To_Integrator
 *
 * @wordpress-plugin
 * Plugin Name:       WP Tawk.to Integrator
 * Plugin URI:        https://danukaprasad.com'plugins/wp-tawk-to-integrator
 * Description:       Add Tawk.to chat widget to your WordPress website and customize it the way you want.
 * Version:           1.0.0
 * Author:            ABD Prasad
 * Author URI:        https://danukaprasad.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-tawk-to-integrator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (! defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WP_TAWK_TO_INTEGRATOR_VERSION', '1.0.0');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-tawk-to-integrator-activator.php
 */
function activate_wp_tawk_to_integrator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-wp-tawk-to-integrator-activator.php';
	Wp_Tawk_To_Integrator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-tawk-to-integrator-deactivator.php
 */
function deactivate_wp_tawk_to_integrator()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-wp-tawk-to-integrator-deactivator.php';
	Wp_Tawk_To_Integrator_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wp_tawk_to_integrator');
register_deactivation_hook(__FILE__, 'deactivate_wp_tawk_to_integrator');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wp-tawk-to-integrator.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_tawk_to_integrator()
{

	$plugin = new Wp_Tawk_To_Integrator();
	$plugin->run();
}
run_wp_tawk_to_integrator();
