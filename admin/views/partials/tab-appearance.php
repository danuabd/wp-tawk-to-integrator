<?php

/**
 * The view for the "Appearance" tab in the admin settings page.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    WP_Tawk_To_Integrator
 * @subpackage WP_Tawk_To_Integrator/admin/views/partials
 */
if (! defined('WPINC')) {
    die;
}

$options = get_option('wp-tawk-to-integrator_options');
?>

<!-- Appearance tab content -->
<div
    data-relation="appearance"
    id="appearance-section"
    class="hidden tab-content">
    <!-- heading section -->
    <div class="mb-8">
        <h2 class="mb-2 text-xl font-semibold text-gray-700">
            Appearance Settings
        </h2>
        <p class="text-gray-600">
            Customize the look and feel of your Tawk.to chat widget.
            Adjust colors, position, and visibility to match your site's
            design.
        </p>
    </div>

    <!-- page visibility section -->
    <div class="mb-8 space-y-4 border-t border-gray-200 pt-4">
        <h3 class="text-lg font-semibold text-gray-700">
            Page visibility
        </h3>
        <p class="mb-6 text-sm text-gray-600">
            Control on which pages the Tawk.to widget appears. You can
            enter page ids to hide the widget from them (ex: 1002, 892 ,
            33).
        </p>

        <!-- hide widget on pages -->
        <div>
            <div class="space-y-3 mb-2 max-w-xl">
                <span class="mb-2 block text-sm font-medium text-gray-700">Hide widget on specific pages:
                </span>
                <div
                    class="pages-to-hide flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
                    <input
                        type="text"
                        name="wp-tawk-to-integrator_options[page-ids-to-hide]"
                        value="<?php echo isset($options['page-ids-to-hide']) ? esc_attr($options['page-ids-to-hide']) : ''; ?>"
                        placeholder="Page IDs"
                        id="hide-on-pages-input"
                        data-role="input-page-ids"
                        data-displayId="hidden-pages"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
                    <button
                        type="button"
                        data-role="clear"
                        class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                        Clear
                    </button>
                </div>
                <p class="mt-1 text-xs text-gray-500">
                    Add page IDs where the widget should be hidden.
                </p>
            </div>
            <!-- hidden pages will appear here -->
            <div
                id="hidden-pages"
                class="mt-2 flex flex-wrap gap-1"></div>
        </div>
    </div>
    <div
        class="sub-sec-usr-visibility mb-8 space-y-4 border-t border-gray-200 pt-4">
        <div class="mb-6">
            <h3 class="mb-4 text-lg font-semibold text-gray-700">
                User visibility
            </h3>
            <p class="text-sm text-gray-600">
                Determine which WordPress user roles can see the Tawk.to
                widget. This allows you to tailor the chat experience for
                different user groups.
            </p>
        </div>

        <!-- hide widget for users -->
        <div class="mb-8">
            <div id="hide-widget-for-users-wrapper" class="pl-1 mb-6">
                <div class="mb-6 flex items-center space-x-3">
                    <label class="switch">
                        <input
                            type="checkbox"
                            id="hide-for-administrator-checkbox"
                            name="wp-tawk-to-integrator_options[hide-for-administrator-role]"
                            value="<?php echo isset($options['hide-for-administrator-role']) ? esc_attr($options['hide-for-administrator-role']) : ''; ?>"
                            class="w-4 h-4 accent-green-600 toggle"
                            role="switch"
                            <?php echo (isset($options['hide-for-administrator-role']) && $options['hide-for-administrator-role'] === 1) ? 'checked' : ''; ?> />
                        <span class="slider round"></span>
                    </label>
                    <label
                        for="hide-for-administrator-checkbox"
                        class="text-sm font-medium text-gray-700">Administrator</label>
                </div>
                <div class="mb-6 flex items-center space-x-3">
                    <label class="switch">
                        <input
                            type="checkbox"
                            id="hide-for-editor-checkbox"
                            name="wp-tawk-to-integrator_options[hide-for-editor-role]"
                            value="<?php echo isset($options['hide-for-editor-role']) ? $options['hide-for-editor-role'] : '' ?>"
                            class="w-4 h-4 accent-green-600 toggle"
                            role="switch"
                            <?php echo (isset($options['hide-for-editor-role']) && $options['hide-for-editor-role'] === 1) ? 'checked' : '' ?> />
                        <span class="slider round"></span>
                    </label>
                    <label
                        for="hide-for-editor-checkbox"
                        class="text-sm font-medium text-gray-700">Editor</label>
                </div>
                <div class="mb-6 flex items-center space-x-3">
                    <label class="switch">
                        <input
                            type="checkbox"
                            id="hide-for-author-checkbox"
                            name="wp-tawk-to-integrator_options[hide-for-author-role]"
                            value="<?php echo isset($options['hide-for-author-role']) ? $options['hide-for-author-role'] : '' ?>"
                            class="w-4 h-4 accent-green-600 toggle"
                            role="switch"
                            <?php echo (isset($options['hide-for-author-role']) && $options['hide-for-author-role'] === 1) ? 'checked' : ''; ?> />
                        <span class="slider round"></span>
                    </label>

                    <label
                        for="hide-for-author-checkbox"
                        class="text-sm font-medium text-gray-700">Author
                    </label>
                </div>
                <div class="mb-6 flex items-center space-x-3">
                    <label class="switch"><input
                            type="checkbox"
                            id="hide-for-contributor-checkbox"
                            name="wp-tawk-to-integrator_options[hide-for-contributor-role]"
                            value="<?php echo isset($options['hide-for-contributor-role']) ? $options['hide-for-contributor-role'] : '' ?>"
                            class="w-4 h-4 accent-green-600 toggle"
                            role="switch"
                            <?php echo (isset($options['hide-for-contributor-role']) && $options['hide-for-contributor-role'] === 1) ? 'checked' : ''; ?> />
                        <span class="slider round"></span>
                    </label>

                    <label
                        for="hide-for-contributor-checkbox"
                        class="text-sm font-medium text-gray-700">Contributor</label>
                </div>
                <div class="mb-6 flex items-center space-x-3">
                    <label class="switch">
                        <input
                            type="checkbox"
                            id="hide-for-subscriber-checkbox"
                            name="wp-tawk-to-integrator_options[hide-for-subscriber-role]"
                            value="<?php echo isset($options['hide-for-subscriber-role']) ? $options['hide-for-subscriber-role'] : '' ?>"
                            class="w-4 h-4 accent-green-600 toggle"
                            role="switch"
                            <?php echo (isset($options['hide-for-subscriber-role']) && $options['hide-for-subscriber-role'] === 1) ? 'checked' : ''; ?> />

                        <span class="slider round"></span>
                    </label>

                    <label
                        for="hide-for-subscriber-checkbox"
                        class="text-sm font-medium text-gray-700">Subscriber</label>
                </div>
                <div class="flex items-center space-x-3">
                    <label class="switch">
                        <input
                            type="checkbox"
                            id="hide-for-customer-checkbox"
                            name="wp-tawk-to-integrator_options[hide-for-customer-role]"
                            value="<?php echo isset($options['hide-for-customer-role']) ? $options['hide-for-customer-role'] : '' ?>"
                            class="w-4 h-4 accent-green-600 toggle"
                            role="switch"
                            <?php echo (isset($options['hide-for-customer-role']) && $options['hide-for-customer-role'] === 1) ? 'checked' : ''; ?> />
                        <span class="slider round"></span>
                    </label>

                    <label
                        for="hide-for-customer-checkbox"
                        class="text-sm font-medium text-gray-700">Customer (Logged in)
                    </label>
                </div>
            </div>
            <button
                id="reset-role-button"
                type="button"
                data-role="reset"
                data-itemsContainer="hide-widget-for-users-wrapper"
                class="reset-btn mt-4 px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                Reset Selections
            </button>
        </div>

        <!-- show/hide widget for logged-in/out users -->
        <div class="mb-6 flex items-center space-x-3">
            <label class="switch">
                <input
                    checked
                    id="show-widget-for-guests-toggle"
                    name="wp-tawk-to-integrator_options[show-widget-for-guests]"
                    value="<?php echo isset($options['show-widget-for-guests']) ? $options['show-widget-for-guests'] : '' ?>"
                    type="checkbox"
                    role="switch"
                    class="toggle"
                    <?php echo (isset($options['show-widget-for-guests']) && $options['show-widget-for-guests'] === 1) ? 'checked' : ''; ?> />
                <span class="slider round"></span>
            </label>
            <label
                class="text-sm font-medium text-gray-700"
                for="show-widget-for-guests-toggle">Show widget for non-logged-in users (guests)</label>
        </div>
    </div>
</div>