<?php

/**
 * The plugin bootstrap file
 *
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
 * Current plugin version.
 */
define('WP_TAWK_TO_INTEGRATOR_VERSION', '1.0.0');
define('WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('WP_TAWK_TO_INTEGRATOR_PLUGIN_URL', plugin_dir_url(__FILE__));
define('WP_TAWK_TO_INTEGRATOR_OPTIONS_GROUP_KEY', 'wp-tawk-to-integrator_options_group');
define('WP_TAWK_TO_INTEGRATOR_OPTION_KEY', 'wp-tawk-to-integrator_options');

/**
 * The code that runs during plugin activation.
 */
function activate_wp_tawk_to_integrator()
{
	require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator-activator.php';
	Wp_Tawk_To_Integrator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_wp_tawk_to_integrator()
{
	require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator-deactivator.php';
	Wp_Tawk_To_Integrator_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wp_tawk_to_integrator');
register_deactivation_hook(__FILE__, 'deactivate_wp_tawk_to_integrator');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator.php';

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
