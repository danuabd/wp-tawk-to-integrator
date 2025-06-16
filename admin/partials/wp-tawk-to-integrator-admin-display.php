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
            settings_fields('wp-tawk-to-integrator_options_group');
            ?>

            <!-- Tabs -->
            <div id="tabs-button-wrapper" class="mb-6">
                <div class="flex space-x-1 border-b border-gray-200">
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=integration"
                        data-relation="integration-section"
                        id="integration"
                        role="button"
                        class="<?php echo $active_tab === 'integration' ? 'tab-active' : ''; ?> tab-btn rounded-t-md px-6 py-3 text-sm font-medium">
                        Integration
                    </a>
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=appearance"
                        data-relation="appearance-section"
                        id="appearance"
                        role="button"
                        class="<?php echo $active_tab === 'appearance' ? 'tab-active' : ''; ?> tab-btn rounded-t-md px-6 py-3 text-sm font-medium">
                        Appearance
                    </a>
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=behavior"
                        data-relation="behavior-section"
                        id="behavior"
                        role="button"
                        class="<?php echo $active_tab === 'behavior' ? 'tab-active' : ''; ?> tab-btn rounded-t-md px-6 py-3 text-sm font-medium">
                        Behavior
                    </a>
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=events"
                        data-relation="events-section"
                        id="events"
                        role="button"
                        class="<?php echo $active_tab === 'events' ? 'tab-active' : ''; ?> tab-btn rounded-t-md px-6 py-3 text-sm font-medium">
                        Events
                    </a>
                    <a
                        href="?page=wp-tawk-to-integrator-settings&tab=pro"
                        data-relation="pro-section"
                        id="pro"
                        role="button"
                        class="<?php echo $active_tab === 'pro' ? 'tab-active' : ''; ?> tab-btn relative rounded-t-md px-6 py-3 text-sm font-medium">
                        Pro
                        <span
                            class="material-icons-outlined text-mint-2 absolute top-1 right-1 text-sm"
                            style="font-size: 16px">diamond</span>
                    </a>
                </div>
            </div>

            <!-- Tabs content -->
            <div id="tabs-content-wrapper" class="space-y-6">
                <div
                    data-relation="integration"
                    id="integration-section"
                    class="<?php $active_tab !== 'integration' ? 'hidden' : '' ?> tab-content">
                    <?php

                    // Integration view
                    require_once __DIR__ . '/views/integration-view.php';

                    ?>
                </div>

                <div
                    data-relation="appearance"
                    id="appearance-section"
                    class="<?php $active_tab !== 'appearance' ? 'hidden' : '' ?> tab-content">
                    <?php

                    // Appearance view
                    require_once __DIR__ . '/views/appearance-view.php';

                    ?>
                </div>

                <div
                    data-relation="behavior"
                    id="behavior-section"
                    class="<?php $active_tab !== 'behavior' ? 'hidden' : '' ?> tab-content space-y-6">
                    <?php

                    // Behavior view
                    require_once __DIR__ . '/views/behavior-view.php';

                    ?>
                </div>

                <div
                    data-relation="events"
                    id="events-section"
                    class="<?php $active_tab !== 'events' ? 'hidden' : '' ?> tab-content space-y-6">
                    <?php

                    // Events view
                    require_once __DIR__ . '/views/events-view.php';

                    ?>
                </div>

                <div
                    data-relation="pro"
                    id="pro-section"
                    class="<?php $active_tab !== 'pro' ? 'hidden' : '' ?> tab-content pro-section-container my-6 space-y-6">
                    <?php

                    // Pro view
                    require_once __DIR__ . '/views/pro-view.php';

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

            <!-- referrer -->
            <input type="hidden" name="_wp_http_referer" value="<?php echo esc_url(add_query_arg('tab', $active_tab)); ?>" />
        </form>
    </div>
</div>

<!-- Alert box -->
<div id="custom-alert-overlay" class="hidden"></div>
<div id="custom-alert-box" class="hidden"></div>