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
    public static function get_plugin_name()
    {
        return 'wp-tawk-to-integrator';
    }

    /**
     * Get plugin version
     */
    public static function get_plugin_version()
    {
        return '1.0.0';
    }

    /**
     * Get main plugin file path
     */
    public static function get_main_file_path()
    {
        return plugin_dir_path(__DIR__) . '../' . self::get_plugin_name() . '.php';
    }

    /**
     * Get absolute path to plugin folder
     */
    public static function get_plugin_path()
    {
        return plugin_dir_path(self::get_main_file_path());
    }

    /**
     * Get Plugin URL
     */
    public static function get_plugin_url()
    {
        return plugin_dir_url(self::get_main_file_path());
    }

    /**
     * Get DB option key name
     */
    public static function get_option_name()
    {
        return self::get_plugin_name() . '_options';
    }

    /**
     * Get Option group
     */
    public static function get_option_group()
    {
        return self::get_plugin_name() . '_options_group';
    }
}
