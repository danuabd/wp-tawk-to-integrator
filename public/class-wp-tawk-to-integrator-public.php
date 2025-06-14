<?php

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and hooks for actions and filters.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    WP_Tawk_To_Integrator
 * @subpackage WP_Tawk_To_Integrator/public
 */

if (! defined('WPINC')) {
    die;
}

class WP_Tawk_To_Integrator_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * The plugin options.
     *
     * @since    1.0.0
     * @access   private
     * @var      array    $options    The plugin options.
     */
    private $options;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param    string    $plugin_name       The name of the plugin.
     * @param    string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        // Load the plugin's options. These would be used to get the Tawk.to Property ID, Widget ID etc.
        $this->options = get_option($this->plugin_name . '_options');
    }

    /**
     * Enqueue scripts and styles for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        // Example: Enqueue a public-facing script if needed.
        // For Tawk.to, the widget script is usually added directly to the footer.
        // wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-tawk-to-integrator-public.js', array( 'jquery' ), $this->version, true );
    }

    /**
     * Embed the Tawk.to chat widget script in the footer.
     *
     * This is a placeholder. Actual implementation will require fetching
     * the Property ID and Widget ID from plugin settings.
     *
     * @since    1.0.0
     */
    public function embed_tawk_to_widget()
    {
        // Example structure, actual script will come from Tawk.to
    }
}
