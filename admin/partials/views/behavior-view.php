<?php

/**
 * The view for the "Behavior" tab in the admin settings page.
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

<!-- Behavior tab content -->
<div>
    <div class="mb-8">
        <h2 class="text-xl font-semibold text-gray-700 mb-2">
            Behavior Settings
        </h2>
        <p class="text-gray-600">
            Configure how the Tawk.to chat widget interacts with users and
            integrates with your WordPress site data.
        </p>
    </div>
    <div class="mb-6 space-y-4 pt-4 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-gray-700">
            Manage Widget State
        </h3>
        <p class="text-gray-600 text-sm">
            Control how and when the chat widget actively engages the user
            or becomes visible based on specific interactions or timing.
        </p>
        <div>
            <div class="space-y-3 mb-2 max-w-md">
                <span class="mb-2 block text-sm font-medium text-gray-700">Element ID or Class for Maximize Trigger:
                </span>
                <div
                    class="trigger-selector flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
                    <input
                        type="text"
                        name="wp-tawk-to-integrator_options[widget_maximize_element_input]"
                        value="<?php echo isset($options['widget_maximize_element_input']) ? $options['widget_maximize_element_input'] : ''  ?>"
                        placeholder="#help-button or .chat-trigger"
                        id="element-to-trigger-widget-when-clicked"
                        data-role="input-selector"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
                    <button
                        type="button"
                        data-role="clear"
                        data-elementId="element-to-trigger-widget-when-clicked"
                        class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                        Clear
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Automatically open (maximize) the chat widget when a user
                    clicks a specific button or link on your page.
                </p>
            </div>
        </div>
    </div>
    <div
        class="mb-6 max-w-4xl space-y-4 pt-4 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-gray-700">
            Visitor Information
        </h3>
        <p class="text-gray-600 text-sm">
            Personalize the chat experience by automatically providing
            visitor details to your Tawk.to agents, improving context and
            efficiency.
        </p>
        <div class="flex items-center space-x-3 mt-2">
            <label class="switch">
                <input
                    id="auto-populate-user-data-toggle"
                    name="wp-tawk-to-integrator_options[auto_populate_userdata_check]"
                    value="<?php echo isset($options['auto_populate_userdata_check']) ? $options['auto_populate_userdata_check'] : ''  ?>"
                    type="checkbox"
                    role="switch"
                    class="toggle"
                    <?php echo (isset($options['auto_populate_userdata_check']) && $options['auto_populate_userdata_check'] === '1') ? 'checked' : '' ?> />
                <span class="slider round"></span>
            </label>
            <label
                class="text-sm font-medium text-gray-700"
                for="auto-populate-user-data-toggle">Pre-fill name and email for logged-in WordPress
                users</label>
        </div>
        <p class="text-xs text-gray-500 mt-1">
            When enabled, if a visitor is logged into your WordPress site,
            their name and email will be automatically passed to the chat
            widget.
        </p>

        <div class="space-y-4 pt-4">
            <h4 class="text-md mb-4 font-semibold text-gray-700">
                Pass Custom Attributes for Logged-in Users
            </h4>
            <p class="text-gray-600 text-sm">
                Send additional relevant data about logged-in WordPress
                users to Tawk.to. Define attribute keys (which become labels
                in Tawk.to) and map them to WordPress user meta keys or
                predefined plugin placeholders.
            </p>
            <div class="space-y-3 mb-2 max-w-4xl">
                <span class="mb-2 block text-sm font-medium text-gray-700">Add custom attributes:
                </span>
                <div
                    class="pages-to-hide flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
                    <input
                        type="text"
                        name="wp-tawk-to-integrator_options[custom_attributes_input]"
                        value="<?php echo isset($options['custom_attributes_input']) ? $options['custom_attributes_input'] : '' ?>"
                        placeholder="key_1:value_1, key_2:value_2"
                        data-role="input-custom-attributes"
                        id="custom-attributes-input"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
                    <button
                        type="button"
                        data-role="clear"
                        data-elementId="custom-attributes-input"
                        class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                        Clear
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Add each attribute as "key:value" pair. Use comma "," to
                    separate multiple attributes
                </p>
            </div>
        </div>
    </div>
    <div
        class="mb-6 max-w-4xl space-y-4 pt-4 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-gray-700">
            Customization &amp; Control (Secure Mode)
        </h3>
        <p class="text-gray-600 text-sm">
            Enhance the security and continuity of chat history for your
            logged-in WordPress users by verifying their identity with
            Tawk.to.
        </p>
        <div class="flex items-center space-x-3 mt-2">
            <label class="switch">
                <input
                    id="enable-secure-mode-toggle"
                    name="wp-tawk-to-integrator_options[secure_mode_check]"
                    value="<?php echo isset($options['secure_mode_check']) ? $options['secure_mode_check'] : ''  ?>"
                    type="checkbox"
                    data-role="reveal"
                    data-elementId="tawk-api-key-container"
                    role="switch"
                    class="toggle"
                    <?php echo (isset($options['secure_mode_check']) && $options['secure_mode_check'] === '1') ? 'checked' : ''  ?> />
                <span class="slider round"></span>
            </label>
            <label
                class="text-sm font-medium text-gray-700"
                for="enable-secure-mode-toggle">Enable Secure Mode for Logged-in Users</label>
        </div>
        <p class="text-xs text-gray-500 mt-1">
            This feature securely links a user's WordPress account with
            their Tawk.to chat identity, ensuring chat history is
            correctly associated. You must also enable Secure Mode in your
            Tawk.to Property settings (Administration &gt; Overview &gt;
            JavaScript API) for this to work.
        </p>
        <div class="hidden" id="tawk-api-key-container">
            <div class="space-y-3 mb-2 max-w-4xl">
                <span class="mb-2 block text-sm font-medium text-gray-700">Tawk.to API Key:
                </span>
                <div
                    class="tawk-api-key flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
                    <input
                        type="text"
                        name="wp-tawk-to-integrator_options[tawk_api_key_input]"
                        value="<?php echo isset($options['tawk_api_key_input']) ? $options['tawk_api_key_input'] : '' ?>"
                        placeholder="01xx8219xxx7xxxx39x8xxxxxxxx1258xxx"
                        id="tawk-api-key-input"
                        data-role="tawk-api-key-input"
                        data-toggleId="enable-secure-mode-toggle"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
                    <button
                        type="button"
                        data-role="clear"
                        data-elementId="tawk-api-key-input"
                        class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                        Remove Key
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Enter your Tawk.to API Key, found in your Tawk.to
                    Dashboard (usually under Profile icon &gt; API Keys). This
                    is required to generate the secure hash for API
                    authentication.
                </p>
            </div>
        </div>
    </div>
</div>