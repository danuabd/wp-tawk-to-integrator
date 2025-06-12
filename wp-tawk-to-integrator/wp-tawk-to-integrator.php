<?php
/**
 * Plugin Name:       WP Tawk.to Integrator
 * Plugin URI:        https://danukaprasad.com/plugins/tawk-to
 * Description:       Add Tawk.to chat widget to your WordPress website and customize it the way you want.
 * Version:           1.0.0
 * Requires at least: 5.0
 * Requires PHP:      8.0
 * Author:            ABD Prasad
 * Author URI:        https://danukaprasad.com
 * License:           GPL-3.0
 * License URI:       https://www.gnu.org/licenses/gpl-3.0.en.html
 * Text Domain:       wp-tawk-to-integrator
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * The code that runs during plugin activation.
 */
function wp_tawk_to_integrator_activate() {
    // Activation tasks go here.
    // For example, set default options.
}
register_activation_hook( __FILE__, 'wp_tawk_to_integrator_activate' );

/**
 * The code that runs during plugin deactivation.
 */
function wp_tawk_to_integrator_deactivate() {
    // Deactivation tasks go here.
}
register_deactivation_hook( __FILE__, 'wp_tawk_to_integrator_deactivate' );

/**
 * The code that runs during plugin uninstall.
 * This is hooked in the main plugin file for WordPress to detect it.
 */
function wp_tawk_to_integrator_uninstall() {
    // If uninstall not called from WordPress, then exit.
    if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
        exit;
    }

    // Delete the main plugin options.
    // The option name 'wp-tawk-to-integrator_options' should match what was registered
    // in WP_Tawk_To_Integrator_Admin::register_settings().
    delete_option( 'wp-tawk-to-integrator_options' );

    // If there are other options or transients, delete them here as well.
    // For example:
    // delete_transient( 'wp_tawk_to_integrator_some_transient' );
    // global $wpdb;
    // $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}my_custom_table" );
}
register_uninstall_hook( __FILE__, 'wp_tawk_to_integrator_uninstall' );

// Define plugin constants
define( 'WP_TAWK_TO_INTEGRATOR_VERSION', '1.0.0' );
define( 'WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'WP_TAWK_TO_INTEGRATOR_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include the class file that handles admin-specific hooks
require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'admin/class-wp-tawk-to-integrator-admin.php';

// Include the class file that handles public-facing functionality
require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'public/class-wp-tawk-to-integrator-public.php';

// Placeholder for including the main plugin class (if you have one that orchestrates public and admin)
// require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator.php';

/**
 * Begins execution of the plugin's admin features.
 *
 * Since everything within the admin class is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_tawk_to_integrator_admin() {
    $plugin_admin = new WP_Tawk_To_Integrator_Admin( 'wp-tawk-to-integrator', WP_TAWK_TO_INTEGRATOR_VERSION );
    add_action( 'admin_menu', array( $plugin_admin, 'add_admin_menu' ) );
    add_action( 'admin_init', array( $plugin_admin, 'register_settings' ) );
}
run_wp_tawk_to_integrator_admin();

/**
 * Begins execution of the public-facing part of the plugin.
 *
 * @since    1.0.0
 */
function run_wp_tawk_to_integrator_public() {
    $plugin_public = new WP_Tawk_To_Integrator_Public( 'wp-tawk-to-integrator', WP_TAWK_TO_INTEGRATOR_VERSION );
    // Enqueue scripts and styles (if any for public)
    // add_action( 'wp_enqueue_scripts', array( $plugin_public, 'enqueue_scripts' ) );

    // Embed the Tawk.to widget
    add_action( 'wp_footer', array( $plugin_public, 'embed_tawk_to_widget' ) );
}
run_wp_tawk_to_integrator_public();


// Placeholder for initializing the main plugin (if you have one that orchestrates public, admin, and shared functionality)
// function run_wp_tawk_to_integrator() {
//     $plugin = new Wp_Tawk_To_Integrator(); // This would be a new class in includes/
//     $plugin->run();
// }
// run_wp_tawk_to_integrator();

?>
