<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @subpackage Wp_Tawk_To_Integrator/admin/partials
 */
if (! defined('WPINC')) {
    die;
}

if (!$option_group || !$option_name || !$allowed_tabs) return new WP_Error('Could not find option_name');

// Get the options from the database
$options = get_option($option_name);

/**
 * Create HTML checked attribute
 *
 * @param string $value Value to use
 * @return string
 */
$options['create_checked_attr'] = function ($value) {

    if (!isset($value) || $value === '' || $value == 0) {

        return '';
    } else {

        return 'checked';
    }
};

/**
 * Create HTML value attribute
 *
 * @param string $value Value to use
 */
$options['create_value_attr'] = function ($value) {
    if (!isset($value) || $value === '' || $value == 0) {

        return '';
    } else {

        return 'value = "' . esc_attr($value) . '"';
    }
};

// Get the current tab from the URL, or set a default
$active_tab = isset($_GET['tab']) && in_array($_GET['tab'], $allowed_tabs) ? $_GET['tab'] : 'integration';

// Display "Settings saved." notice
settings_errors();
?>

<div id="wp-tawk-to-integrator-wrapper" class="wp-tawk-to-integrator-wrapper bg-gray-100 p-6 flex items-center justify-center">
    <div class="max-w-4xl rounded-lg bg-white p-8 shadow-lg">
        <div class="plugin-header mb-8 flex items-center">
            <?php

            // get page header
            require_once __DIR__ . '/views/header-view.php'

            ?>
        </div>
        <form id="wpti-admin-form"
            autocomplete="off"
            action="options.php"
            method="post">
            <?php
            settings_fields($option_group);
            ?>

            <!-- Tabs convenience -->
            <div id="tabs-button-wrapper" class="mb-6">
                <div class="flex space-x-1 border-b border-gray-200">
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=integration"
                        data-relation="integration-section"
                        id="integration"
                        role="button"
                        class="tab-btn rounded-t-md px-6 py-3 text-sm font-medium <?php echo $active_tab === 'integration' ? 'tab-active' : ''; ?>">
                        Integration
                    </a>
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=appearance"
                        data-relation="appearance-section"
                        id="appearance"
                        role="button"
                        class="tab-btn rounded-t-md px-6 py-3 text-sm font-medium <?php echo $active_tab === 'appearance' ? 'tab-active' : ''; ?>">
                        Appearance
                    </a>
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=behavior"
                        data-relation="behavior-section"
                        id="behavior"
                        role="button"
                        class="tab-btn rounded-t-md px-6 py-3 text-sm font-medium <?php echo $active_tab === 'behavior' ? 'tab-active' : ''; ?>">
                        Behavior
                    </a>
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=events"
                        data-relation="events-section"
                        id="events"
                        role="button"
                        class="tab-btn rounded-t-md px-6 py-3 text-sm font-medium <?php echo $active_tab === 'events' ? 'tab-active' : ''; ?>">
                        Events
                    </a>
                </div>
            </div>

            <!-- Tabs content -->
            <div id="tabs-content-wrapper" class="space-y-6">
                <!-- Integration -->
                <div
                    data-relation="integration"
                    id="integration-section"
                    class="tab-content <?php echo 'integration' === $active_tab ? '' : 'hidden'; ?>">

                    <?php

                    $data = array(
                        'option_name' => $option_name,
                        'property_id' => $options['property_id'] ?? '',
                        'widget_id' => $options['widget_id'] ?? '',
                        'z_index' => $options['z_index'] ?? '',
                        'activate_widget' => $options['activate_widget'] ?? '',
                        'create_checked_attr' => $options['create_checked_attr'],
                        'create_value_attr' => $options['create_value_attr']
                    );

                    extract($data);
                    require_once __DIR__ . '/views/integration-view.php';

                    ?>

                </div>

                <!-- Appearance -->
                <div
                    data-relation="appearance"
                    id="appearance-section"
                    class="tab-content <?php echo 'appearance' === $active_tab ? '' : 'hidden'; ?>">

                    <?php

                    $data = array(
                        'option_name' => $option_name,
                        'pages_to_hide' => $options['pages_to_hide'] ?? '',
                        'hide_widget_administrator_role' => $options['hide_widget_administrator_role'] ?? '',
                        'hide_widget_editor_role' => $options['hide_widget_editor_role'] ?? '',
                        'hide_widget_author_role' => $options['hide_widget_author_role'] ?? '',
                        'hide_widget_contributor_role' => $options['hide_widget_contributor_role'] ?? '',
                        'hide_widget_subscriber_role' => $options['hide_widget_subscriber_role'] ?? '',
                        'hide_widget_customer_role' => $options['hide_widget_customer_role'] ?? '',
                        'show_widget_to_guest' => $options['show_widget_to_guest'] ?? '',
                        'create_checked_attr' => $options['create_checked_attr'],
                        'create_value_attr' => $options['create_value_attr']
                    );

                    extract($data);

                    require_once __DIR__ . '/views/appearance-view.php';

                    ?>

                </div>

                <!-- Behavior -->
                <div
                    data-relation="behavior"
                    id="behavior-section"
                    class="tab-content space-y-6 <?php echo 'behavior' === $active_tab ? '' : 'hidden'; ?>">

                    <?php

                    $data = array(
                        'option_name' => $option_name,
                        'widget_maximize_element' => $options['widget_maximize_element'] ?? '',
                        'auto_populate_userdata' => $options['auto_populate_userdata'] ?? '',
                        'secure_mode' => $options['secure_mode'] ?? '',
                        'tawk_api_key' => $options['tawk_api_key'] ?? '',
                        'create_checked_attr' => $options['create_checked_attr'],
                        'create_value_attr' => $options['create_value_attr']
                    );

                    extract($data);

                    require_once __DIR__ . '/views/behavior-view.php';

                    ?>

                </div>

                <!-- Events -->
                <div
                    data-relation="events"
                    id="events-section"
                    class="tab-content space-y-6 <?php echo 'events' === $active_tab ? '' : 'hidden'; ?>">

                    <?php

                    $data = array(
                        'option_name' => $option_name,
                        'widget_onload_customize' => $options['widget_onload_customize'] ?? '',
                        'widget_render_delay' => $options['widget_render_delay'] ?? '',
                        'custom_js_onload' => $options['custom_js_onload'] ?? '',
                        'create_checked_attr' => $options['create_checked_attr'],
                        'create_value_attr' => $options['create_value_attr']
                    );

                    extract($data);

                    require_once __DIR__ . '/views/events-view.php';

                    ?>

                </div>
            </div>

            <!-- Form submission -->
            <div class="pt-4">
                <button
                    id="form-submit-btn"
                    class="bg-mint-2 hover:bg-sea-green focus:ring-mint-2 rounded-md px-6 py-2 font-semibold text-white focus:ring-2 focus:ring-offset-2 focus:outline-none"
                    type="submit">
                    Save Changes
                </button>
            </div>

            <?php
            // Build the redirect URL explicitly to ensure correctness
            $settings_page_url = menu_page_url($option_name . '-settings', false);
            $redirect_url      = add_query_arg('tab', $active_tab, $settings_page_url);
            ?>
            <input type="hidden" id="active_tab_url" name="_wp_http_referer" value="<?php echo esc_url($redirect_url); ?>" />
        </form>
    </div>
</div>

<!-- Alert box -->
<div id="custom-alert-overlay" class="hidden"></div>
<div id="custom-alert-box" class="hidden"></div>