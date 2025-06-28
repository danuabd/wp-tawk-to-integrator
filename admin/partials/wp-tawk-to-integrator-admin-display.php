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

/**
 * Get Config class
 */
require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/class-wp-tawk-to-integrator-config.php';

// Define the allowed tabs
$allowed_tabs = ['integration', 'appearance', 'behavior', 'events', 'pro'];

// Get the current tab from the URL, or set a default
$active_tab = isset($_GET['tab']) && in_array($_GET['tab'], $allowed_tabs) ? $_GET['tab'] : 'integration';
?>
<?php
// ==========================================================
// Display "Settings saved." notice
settings_errors();
// ==========================================================
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
            settings_fields(Wp_Tawk_To_Integrator_Config::get_option_name());
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
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=pro"
                        data-relation="pro-section"
                        id="pro"
                        role="button"
                        class="tab-btn relative rounded-t-md px-6 py-3 text-sm font-medium <?php echo $active_tab === 'pro' ? 'tab-active' : ''; ?>">
                        Pro
                        <span
                            class="material-icons-outlined text-mint-2 absolute top-1 right-1 text-sm"
                            style="font-size: 16px">diamond</span>
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
                    <?php require_once __DIR__ . '/views/integration-view.php'; ?>
                </div>

                <!-- Appearance -->
                <div
                    data-relation="appearance"
                    id="appearance-section"
                    class="tab-content <?php echo 'appearance' === $active_tab ? '' : 'hidden'; ?>">
                    <?php require_once __DIR__ . '/views/appearance-view.php'; ?>
                </div>

                <!-- Behavior -->
                <div
                    data-relation="behavior"
                    id="behavior-section"
                    class="tab-content space-y-6 <?php echo 'behavior' === $active_tab ? '' : 'hidden'; ?>">
                    <?php require_once __DIR__ . '/views/behavior-view.php'; ?>
                </div>

                <!-- Events -->
                <div
                    data-relation="events"
                    id="events-section"
                    class="tab-content space-y-6 <?php echo 'events' === $active_tab ? '' : 'hidden'; ?>">
                    <?php require_once __DIR__ . '/views/events-view.php'; ?>
                </div>

                <!-- Pro -->
                <div
                    data-relation="pro"
                    id="pro-section"
                    class="tab-content pro-section-container my-6 space-y-6 <?php echo 'pro' === $active_tab ? '' : 'hidden'; ?>">
                    <?php require_once __DIR__ . '/views/pro-view.php'; ?>
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
            $settings_page_url = menu_page_url(Wp_Tawk_To_Integrator_Config::get_plugin_name() . '-settings', false);
            $redirect_url      = add_query_arg('tab', $active_tab, $settings_page_url);
            ?>
            <input type="hidden" id="active_tab_url" name="_wp_http_referer" value="<?php echo esc_url($redirect_url); ?>" />
        </form>
    </div>
</div>

<!-- Alert box -->
<div id="custom-alert-overlay" class="hidden"></div>
<div id="custom-alert-box" class="hidden"></div>