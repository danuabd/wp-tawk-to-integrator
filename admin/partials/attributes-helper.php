<?php

/**
 * Provides a helper function to construct attributes
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @subpackage Wp_Tawk_To_Integrator/admin/partials
 * @author     ABD Prasad <contact@danukaprasad.com>
 */

/**
 * Create HTML value attribute
 *
 * @param string $value Value to use
 */
function create_value_attr($value)
{
    if (!$value) return '';

    return 'value = "' . esc_attr($value) . '"';
}

/**
 * Create HTML checked attribute
 *
 * @param string $value Value to use
 * @return string
 */
function create_checked_attr($value)
{
    if (!$value) return '';

    return 'checked';
}
