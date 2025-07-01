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
 * Define plugin constants and paths
 *
 * @since 1.0.0
 */
define('WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR', plugin_dir_path(__FILE__));

/**
 * Get plugin config
 *
 * @since 1.0.0
 * @return Wp_Tawk_To_Integrator_Config
 */
if (!class_exists('Wp_Tawk_To_Integrator_Config')) {
	require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator-config.php';
}
$plugin_config = new Wp_Tawk_To_Integrator_Config(
	'wp-tawk-to-integrator',
	'1.0.0',
	array('show_widget_to_guest' => 'on')
);

/**
 * Get all plugin configuration details
 *
 * @since 1.0.0
 * @return array An associative array containing all plugin configuration details.
 */
$plugin_meta = $plugin_config->get_all();

/**
 * The code that runs during plugin activation.
 */
register_activation_hook(__FILE__, function () use ($plugin_meta) {
	require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator-activator.php';

	Wp_Tawk_To_Integrator_Activator::activate(
		$plugin_meta['option_name'],
		$plugin_meta['default_options']
	);

	set_transient('wpti_redirect_on_activation', true, 30);
});

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_wp_tawk_to_integrator()
{
	require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator-deactivator.php';
	Wp_Tawk_To_Integrator_Deactivator::deactivate();
}

register_deactivation_hook(__FILE__, 'deactivate_wp_tawk_to_integrator');

/**
 * Add plugin links
 */
add_filter('plugin_action_links_' . plugin_basename(__FILE__), function ($links) use ($plugin_meta) {

	$reset_url = wp_nonce_url(
		admin_url('plugins.php?plugin=' . $plugin_meta['plugin_name'] . '&action=reset'),
		'reset_plugin_settings'
	);

	$custom_links = [
		'<a href="' . esc_url($reset_url) . '" onclick="return confirm(\'Are you sure you want to reset all plugin settings?\');">Reset Settings</a>'
	];

	return array_merge($custom_links, $links);
});


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
function run_wp_tawk_to_integrator($plugin_meta)
{

	$plugin = new Wp_Tawk_To_Integrator($plugin_meta);
	$plugin->run();
}
run_wp_tawk_to_integrator($plugin_meta);
