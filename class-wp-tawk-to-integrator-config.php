<?php

/**
 * Provide shared plugin constants and paths
 * 
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @author     ABD Prasad <contact@danukaprasad.com>
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
class Wp_Tawk_To_Integrator_Config
{
    /**
     * The name of the plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The name of the plugin.
     */
    private $plugin_name;

    /**
     * The version of the plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_version    The version of the plugin.
     */
    private $plugin_version;

    /**
     * The path to the main plugin file.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $main_file_path    The path to the main plugin file.
     */
    private $main_file_path;

    /**
     * The path to the plugin directory.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_path    The path to the plugin directory.
     */
    private $plugin_path;

    /**
     * The URL to the plugin directory.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_url    The URL to the plugin directory.
     */
    private $plugin_url;

    /**
     * The default options for the plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      array    $default_options    The default options for the plugin.
     */
    private $default_options;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param    string $plugin_name The name of the plugin.
     * @param    string $plugin_version The version of the plugin.
     * @param    array $default_options The default options for the plugin.
     */
    public function __construct($plugin_name, $plugin_version, $default_options)
    {
        // Set the plugin name, version, and default options
        $this->plugin_name = $plugin_name;
        $this->plugin_version = $plugin_version;
        $this->default_options = $default_options;

        // Define the main file path, plugin path, and plugin URL
        $this->main_file_path = plugin_dir_path(__FILE__) . $this->plugin_name . '.php';
        $this->plugin_path = plugin_dir_path($this->main_file_path);
        $this->plugin_url = plugin_dir_url($this->main_file_path);
    }

    /**
     * The name of the option used to store plugin settings.
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $option_name    The name of the option used to store plugin settings.
     */
    public static $option_name = $this->plugin_name . '_option';

    /**
     * The name of the option group used for plugin settings.
     *
     * @since    1.0.0
     * @access   public
     * @var      string    $option_group    The name of the option group used for plugin settings.
     */
    public static $option_group = self::$option_name . '_option_group';

    /**
     * Get all plugin configuration details.
     *
     * @since    1.0.0
     * @return   array    An associative array containing all plugin configuration details.
     */
    public function get_all()
    {
        return array(
            'plugin_name' => $this->plugin_name,
            'plugin_version' => $this->plugin_version,
            'option_name' => self::$option_name,
            'option_group' => self::$option_group,
            'main_file_path' => $this->main_file_path,
            'plugin_path' => $this->plugin_path,
            'plugin_url' => $this->plugin_url,
            'default_options' => $this->default_options,
        );
    }
}
