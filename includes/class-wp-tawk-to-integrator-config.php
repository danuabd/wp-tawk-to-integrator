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

class Plugin_Name_Config
{
    /**
     * Get plugin name
     */
    public static function get_plugin_name()
    {
        return 'wp-tawk-to-integrator';
    }

    /**
     * Get main plugin file path
     */
    public static function get_main_file()
    {
        return plugin_dir_path(__DIR__) . '../' . self::get_plugin_name() . '.php';
    }

    /**
     * Get absolute path to plugin folder
     */
    public static function get_plugin_path()
    {
        return plugin_dir_path(self::get_main_file());
    }

    /**
     * Get Plugin URL
     */
    public static function get_plugin_url()
    {
        return plugin_dir_url(self::get_main_file());
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
