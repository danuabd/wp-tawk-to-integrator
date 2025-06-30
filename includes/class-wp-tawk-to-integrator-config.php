<?php

/**
 * Provide shared plugin constants and paths
 * 
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @subpackage Wp_Tawk_To_Integrator/includes
 * @author     ABD Prasad <contact@danukaprasad.com>
 */

class Wp_Tawk_To_Integrator_Config
{
    /**
     * Get plugin name
     */
    private static function get_plugin_name()
    {
        return 'wp-tawk-to-integrator';
    }

    /**
     * Get plugin version
     */
    private static function get_plugin_version()
    {
        return '1.0.0';
    }

    /**
     * Get main plugin file path
     */
    private static function get_main_file_path()
    {
        return plugin_dir_path(__FILE__) . '../' . self::get_plugin_name() . '.php';
    }

    /**
     * Get absolute path to plugin folder
     */
    private static function get_plugin_path()
    {
        return (plugin_dir_path(self::get_main_file_path()));
    }

    /**
     * Get Plugin URL
     */
    private static function get_plugin_url()
    {
        return plugin_dir_url(self::get_main_file_path());
    }

    /**
     * Get DB option key name
     */
    private static function get_option_name()
    {
        return self::get_plugin_name() . '_option';
    }

    /**
     * Get Option group
     */
    private static function get_option_group()
    {
        return self::get_plugin_name() . '_option_group';
    }

    private static function get_default_options()
    {
        // Define the array of default settings.
        return array(
            'show_widget_to_guest' => 'on',
        );
    }

    public static function get_all()
    {
        return array(
            'plugin_name' => self::get_plugin_name(),
            'plugin_version' => self::get_plugin_version(),
            'main_file_path' => self::get_main_file_path(),
            'plugin_path' => self::get_plugin_path(),
            'plugin_url' => self::get_plugin_url(),
            'option_name' => self::get_option_name(),
            'option_group' => self::get_option_group(),
            'default_options' => self::get_default_options(),
        );
    }
}
