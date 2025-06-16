<?php

/**
 * The view for the "Events" tab in the admin settings page.
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

<!-- Events Tab Content -->
<div>
    <div>
        <h2 class="text-xl font-semibold text-gray-700 mb-1">
            Events Configuration
        </h2>
        <p class="text-gray-600 text-sm">
            Configure how the Tawk.to widget interacts with WordPress
            events and user actions. Set up automatic tagging based on
            page views or element clicks, and leverage Tawk.to's
            JavaScript API callbacks for advanced custom behaviors.
        </p>
    </div>
    <div class="space-y-4 pt-4 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-gray-700">Tagging</h3>
        <p class="text-gray-600 text-sm mb-4">
            Automatically apply tags to visitors in Tawk.to based on the
            pages they visit or specific elements they click on your site.
            This helps provide context to your chat agents.
        </p>

        <!-- Automatic Page Tagging Section -->
        <div class="space-y-4 p-4 border border-gray-200 rounded-md">
            <h4 class="text-md font-semibold text-gray-700">
                Automatic Page Tagging
            </h4>
            <div class="flex items-center space-x-3">
                <label class="switch">
                    <input
                        type="checkbox"
                        id="enable-auto-page-tagging-toggle"
                        name="wp-tawk-to-integrator_options[enable-auto-page-tagging]"
                        value="<?php echo isset($options['enable-auto-page-tagging']) ? $options['enable-auto-page-tagging'] : ''  ?>"
                        data-role="reveal"
                        data-elementId="ignore-pages-from-auto-tagging"
                        role="switch"
                        class="toggle" />
                    <span class="slider round"></span>
                </label>
                <label
                    class="text-sm font-medium text-gray-700"
                    for="enable-auto-page-tagging-toggle">Enable Automatic Page Tagging</label>
            </div>
            <p class="text-xs text-gray-500 mt-1">
                When enabled, this feature automatically tags visitors with
                the <strong>title</strong> of the WordPress page they are
                currently viewing. The raw page title will be used as the
                tag.
            </p>

            <!-- Conditional Sub-Section: Ignore Pages for Automatic Tagging -->
            <div
                class="space-y-3 pt-3 mt-3 border-t border-gray-100 hidden"
                id="ignore-pages-from-auto-tagging">
                <h5 class="text-sm font-semibold text-gray-700">
                    Ignore Pages from Automatic Tagging
                </h5>
                <p class="text-xs text-gray-500">
                    Specify pages that should be excluded from automatic page
                    tagging. Visitors on these pages will not be tagged with
                    the page title.
                </p>
                <label
                    class="inline-block mb-3 text-gray-700 text-xs"
                    for="pages-to-ignore-tagging-input">Enter page IDs to ignore:</label>
                <div
                    class="pages-to-ignore flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
                    <input
                        type="text"
                        name="wp-tawk-to-integrator_options[pages-to-ignore-auto-tagging]"
                        value="<?php echo isset($options['pages-to-ignore-auto-tagging']) ? $options['pages-to-ignore-auto-tagging'] : ''  ?>"
                        id="pages-to-ignore-tagging-input"
                        placeholder="Ex: 1123, 345, 23"
                        data-role="input-page-ids"
                        data-displayId="ignored-tagging-pages"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
                    <button
                        type="button"
                        data-role="clear"
                        data-elementId="pages-to-ignore-tagging-input"
                        class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                        Clear
                    </button>
                </div>

                <div
                    class="mt-2 flex flex-wrap gap-1"
                    id="ignored-tagging-pages"></div>
            </div>
        </div>

        <div
            class="space-y-4 p-4 border border-gray-200 rounded-md mt-4">
            <h4 class="text-md font-semibold text-gray-700">
                Action-Based Tagging (On Element Click)
            </h4>
            <div class="flex items-center space-x-3">
                <label class="switch">
                    <input
                        type="checkbox"
                        id="enable-action-based-targeting-toggle"
                        name="wp-tawk-to-integrator_options[enable-action-based-targeting]"
                        value="<?php echo isset($options['enable-action-based-targeting']) ? $options['enable-action-based-targeting'] : ''  ?>"
                        data-role="reveal"
                        data-elementId="action-based-tagging_rules-container"
                        role="switch"
                        class="toggle"
                        disabled />
                    <span class="slider round"></span>
                </label>
                <label
                    class="text-sm font-medium text-gray-700"
                    for="enable-action-based-targeting-toggle">Enable Action-Based Tagging</label>
            </div>
            <p class="text-xs text-gray-500 mt-1">
                Define rules to apply specific tags when visitors click on
                designated elements on your site.
            </p>
            <div
                class="space-y-3 pt-3 mt-3 border-t border-gray-100 hidden"
                id="action-based-tagging_rules-container">
                <p class="text-xs text-gray-500 mb-3">
                    Create rules to tag users. Each rule consists of CSS
                    selectors for clickable elements and the tag to apply.
                </p>

                <label
                    class="inline-block mb-3 text-gray-700 text-xs"
                    for="pages-to-ignore-action-based-tagging-input">Enter Tag and Element(s) in [Clicked Element
                    Selector(s)]:
                </label>
                <div
                    class="pages-to-ignore flex items-center space-x-2 p-2 border border-gray-300 rounded-md mb-1">
                    <input
                        type="text"
                        name="wp-tawk-to-integrator_options[pages-to-ignore-action-based-targeting]"
                        value="<?php echo isset($options['pages-to-ignore-action-based-targeting']) ? $options['pages-to-ignore-action-based-targeting'] : ''  ?>"
                        id="pages-to-ignore-action-based-tagging-input"
                        placeholder="Ex: tagName:[#el-id, .el-class], tagName2:[#el-id2, .el-cls2]"
                        data-displayId="ignored-action-based-tagging-pages"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
                    <button
                        type="button"
                        data-role="clear"
                        data-elementId="pages-to-ignore-action-based-tagging-input"
                        class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 text-sm">
                        Clear
                    </button>
                </div>

                <div
                    id="ignored-action-based-tagging-pages"
                    class="mt-2 flex flex-wrap gap-1"></div>
                <p class="text-xs text-gray-500">
                    Enter one or more comma-separated CSS selectors (IDs or
                    classes).
                </p>
            </div>
        </div>
    </div>

    <!-- Event Handling Section -->
    <div class="space-y-4 pt-4 border-t border-gray-200">
        <h3 class="text-lg font-semibold text-gray-700">
            Event Handling (JavaScript API Callbacks)
        </h3>
        <p class="text-gray-600 text-sm mb-4">
            Leverage Tawk.to's JavaScript API events to trigger custom
            scripts for advanced functionality, such as analytics
            integration or dynamic widget modifications.
        </p>

        <!-- onLoad Event Customizations -->
        <div class="space-y-4 p-4 border border-gray-200 rounded-md">
            <h4 class="text-md font-semibold text-gray-700">
                `onLoad` Event Customizations
            </h4>
            <div class="flex items-center space-x-3">
                <label class="switch">
                    <input
                        type="checkbox"
                        id="enable-onload-customization-toggle"
                        name="wp-tawk-to-integrator_options[enable-onload-customization]"
                        value="<?php echo isset($options['enable-onload-customization']) ? $options['enable-onload-customization'] : ''  ?>"
                        data-role="reveal"
                        data-elementId="onLoad-customizations-fields"
                        role="switch"
                        class="toggle" />
                    <span class="slider round"></span>
                </label>
                <label
                    class="text-sm font-medium text-gray-700"
                    for="enable-onload-customization-toggle">Enable `onLoad` Customizations</label>
            </div>
            <div
                class="space-y-3 pt-3 mt-3 border-t border-gray-100 hidden"
                id="onLoad-customizations-fields">
                <div class="mb-10">
                    <label
                        class="block text-sm font-medium text-gray-700 mb-2.5"
                        for="delay-widget-display">Delay Widget Display (milliseconds)</label>
                    <div
                        class="max-w-2xs flex items-center space-x-2 p-2 border border-gray-300 rounded-md">
                        <input
                            type="number"
                            name="wp-tawk-to-integrator_options[widget-load-delay-time]"
                            value="<?php echo isset($options['widget-load-delay-time']) ? $options['widget-load-delay-time'] : ''  ?>"
                            id="delay-widget-display"
                            min="0"
                            placeholder="1000 milliseconds = 1 second "
                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm" />
                    </div>

                    <p class="mt-2 text-xs text-gray-500">
                        Delays the visual appearance of the widget after it has
                        loaded. Set to 0 or leave empty for no delay.
                    </p>
                </div>

                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-2.5"
                        for="custom-js-onload">Custom JavaScript for `onLoad` Event</label>
                    <div
                        class="flex flex-col gap-2 items-start space-x-2 p-2 border border-gray-300 rounded-md">
                        <textarea
                            name="wp-tawk-to-integrator_options[custom-js-onload]"
                            value="<?php echo isset($options['custom-js-onload']) ? $options['custom-js-onload'] : ''  ?>"
                            class="block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                            id="custom-js-onload"
                            rows="4"></textarea>
                    </div>

                    <p class="mt-1 text-xs text-gray-500">
                        Your code will run once the Tawk.to widget API is
                        loaded. Example:
                        <code class="code-block">Tawk_API.onLoad = function(){ /* your code here */
                            };</code>
                    </p>
                </div>
            </div>
        </div>

        <!-- onChatStarted / onChatEnded Event Actions -->
        <div
            class="space-y-4 p-4 border border-gray-200 rounded-md mt-4">
            <h4 class="text-md font-semibold text-gray-700">
                `onChatStarted` / `onChatEnded` Event Actions
            </h4>
            <div class="flex items-center space-x-3">
                <label class="switch">
                    <input
                        type="checkbox"
                        id="enable-chat-event-action-toggle"
                        name="wp-tawk-to-integrator_options[enable-chat-event-action]"
                        value="<?php echo isset($options['enable-chat-event-action']) ? $options['enable-chat-event-action'] : ''  ?>"
                        data-role="reveal"
                        data-elementId="chat-event-actions-fields"
                        role="switch"
                        class="toggle"
                        disabled
                        title="Coming soon..." />
                    <span class="slider round"></span>
                </label>
                <label
                    class="text-sm font-medium text-gray-700"
                    for="enable-chat-event-action-toggle">Enable Custom JavaScript for `onChatStarted` /
                    `onChatEnded` Events</label>
            </div>
            <div
                class="space-y-3 pt-3 mt-3 border-t border-gray-100 hidden"
                id="chat-event-actions-fields">
                <div class="mb-8">
                    <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        for="custom-js-onchatstarted">Custom JavaScript for `onChatStarted` Event</label>
                    <div
                        class="flex items-center space-x-2 p-2 border border-gray-300 rounded-md mb-2">
                        <textarea
                            name="wp-tawk-to-integrator_options[custom-js-onchatstarted]"
                            value="<?php echo isset($options['custom-js-onchatstarted']) ? $options['custom-js-onchatstarted'] : ''  ?>"
                            class="block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                            id="custom-js-onchatstarted"
                            rows="4"></textarea>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Code runs when a chat session starts. Example:
                        <code class="code-block">Tawk_API.onChatStarted = function(){ /* your code
                            here */ };</code>
                    </p>
                </div>
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mb-2"
                        for="custom-js-onchatended">Custom JavaScript for `onChatEnded` Event</label>
                    <div
                        class="flex items-center space-x-2 p-2 border border-gray-300 rounded-md mb-2">
                        <textarea
                            class="block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                            id="custom-js-onchatended"
                            name="wp-tawk-to-integrator_options[custom-js-onchatended]"
                            value="<?php echo isset($options['custom-js-onchatended']) ? $options['custom-js-onchatended'] : ''  ?>"
                            rows="4"></textarea>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">
                        Code runs when a chat session ends. Example:
                        <code class="code-block">Tawk_API.onChatEnded = function(){ /* your code here
                            */ };</code>
                    </p>
                </div>
                <p class="text-xs text-gray-500 pt-2">
                    Use these to send data to analytics, trigger surveys, or
                    perform other custom actions.
                </p>
            </div>
        </div>

        <!-- onPrechatSubmit Event Actions -->
        <div
            class="space-y-4 p-4 border border-gray-200 rounded-md mt-4">
            <h4 class="text-md font-semibold text-gray-700">
                `onPrechatSubmit` Event Actions
            </h4>
            <div class="flex items-center space-x-3">
                <label class="switch">
                    <input
                        type="checkbox"
                        id="enable-prechat-submit-actions"
                        name="wp-tawk-to-integrator_options[enable-prechat-submit-actions]"
                        value="<?php echo isset($options['enable-prechat-submit-actions']) ? $options['enable-prechat-submit-actions'] : ''  ?>"
                        data-role="reveal"
                        data-elementId="prechat-submit-actions-fields"
                        role="switch"
                        class="toggle"
                        disabled />

                    <span class="slider round"></span>
                </label>
                <label
                    class="text-sm font-medium text-gray-700"
                    for="enable-prechat-submit-actions-toggle">Enable `onPrechatSubmit` Actions</label>
            </div>
            <div
                class="space-y-3 pt-3 mt-3 border-t border-gray-100 hidden"
                id="prechat-submit-actions-fields">
                <div class="flex items-center space-x-3">
                    <label class="switch">
                        <input
                            type="checkbox"
                            id="capture-prechat-data-toggle"
                            name="wp-tawk-to-integrator_options[capture-prechat-data]"
                            value="<?php echo isset($options['capture-prechat-data']) ? $options['capture-prechat-data'] : ''  ?>"
                            role="switch"
                            class="toggle"
                            disabled />
                        <span class="slider round"></span>
                    </label>
                    <label
                        class="text-sm font-medium text-gray-700"
                        for="capture-prechat-data-toggle">Attempt to Capture Pre-chat Form Data to WordPress
                        Backend</label>
                </div>
                <p class="text-xs text-gray-500 mt-1">
                    If enabled, the plugin will attempt to make pre-chat form
                    data available for backend processing (e.g., via a
                    WordPress action hook). This is an advanced feature and
                    may require custom development to fully utilize.
                </p>
                <div>
                    <label
                        class="block text-sm font-medium text-gray-700 mt-3 mb-2"
                        for="custom-js-onprechatsubmit">Custom JavaScript for `onPrechatSubmit` Event</label>
                    <div
                        class="flex items-center space-x-2 p-2 border border-gray-300 rounded-md mb-2">
                        <textarea
                            name="wp-tawk-to-integrator_options[custom-js-onprechatsubmit]"
                            value="<?php echo isset($options['custom-js-onprechatsubmit']) ? $options['custom-js-onprechatsubmit'] : ''  ?>"
                            class="block w-full px-3 py-2 border border-gray-300 focus:outline-none focus:ring-gray-500 focus:border-gray-500 sm:text-sm"
                            id="custom-js-onprechatsubmit"
                            rows="4"></textarea>
                    </div>

                    <p class="text-xs text-gray-500">
                        Code runs when the pre-chat form is submitted. The
                        submitted <code class="code-block">data</code> object
                        will be available. Example:
                        <code class="code-block">Tawk_API.onPrechatSubmit = function(data){ /* your
                            code here */ };</code>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>