<?php

/**
 * The view for the "Integration" tab in the admin settings page.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @subpackage Wp_Tawk_To_Integrator/admin/partials/views
 */
if (! defined('WPINC')) {
    die;
}

$options = get_option('wp-tawk-to-integrator_options');
?>

<!-- Integration tab content -->
<div>
    <div class="mb-7">
        <h2 class="mb-2 text-xl font-semibold text-gray-700">
            Integration Settings
        </h2>
        <p class="text-gray-600">
            Configure how Tawk.to integrates with your WordPress site.
            Provide your Property ID and Widget ID to get started. You can
            find these details in your Tawk.to dashboard.
        </p>
    </div>
    <div class="mb-6">
        <span class="mb-2 block text-sm font-medium text-gray-700">Property ID</span>
        <div
            class="property-id max-w-lg flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
            <input
                type="text"
                name="wp-tawk-to-integrator_options[property_id]"
                value="<?php echo esc_attr($options['property_id']) ?>"
                placeholder="1241211x44x6x67x27xx5"
                id="property-id-input"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
            <button
                type="button"
                data-role="clear"
                data-elementId="property-id-input"
                class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                Clear
            </button>
        </div>
    </div>
    <div class="mb-6">
        <span class="mb-2 block text-sm font-medium text-gray-700">Widget ID</span>
        <div
            class="widget-id max-w-lg flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
            <input
                type="text"
                name="wp-tawk-to-integrator_options[widget_id]"
                value="<?php echo esc_attr($options['widget_id']) ?>"
                placeholder="1xxx4x8xx"
                id="widget-id-input"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
            <button
                type="button"
                data-role="clear"
                data-elementId="widget-id-input"
                class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                Clear
            </button>
        </div>
    </div>
    <div class="mb-6">
        <span class="mb-2 block text-sm font-medium text-gray-700">Z-index (Optional: Controls precedence over other
            elements.)</span>
        <div
            class="z-index max-w-48 flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
            <input
                type="number"
                name="wp-tawk-to-integrator_options[z_index]"
                value="<?php esc_attr($options['z_index']) ?>"
                placeholder="999"
                min="1"
                max="9999999"
                id="z-index-input"
                class="flex-1 w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
            <button
                type="button"
                data-role="clear"
                data-elementId="z-index-input"
                class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                Clear
            </button>
        </div>
    </div>
    <div class="mb-6 flex items-center space-x-3">
        <label class="switch">
            <input
                name="wp-tawk-to-integrator_options[activate_widget]"
                value="<?php echo $options['activate_widget'] ?>"
                type="checkbox"
                id="activate-widget-toggle"
                class="toggle"
                role="switch"
                <?php echo $options['activate_widget'] === 1 ? 'checked' : '' ?> />
            <span class="slider round"></span>
        </label>
        <label
            class="text-sm font-medium text-gray-700"
            for="activate-widget-toggle">Activate Tawk.to chat widget.</label>
    </div>
</div>