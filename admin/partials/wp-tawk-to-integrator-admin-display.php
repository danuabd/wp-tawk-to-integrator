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

// Get the active tab, default to 'integration'
// $active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'integration';
$plugin_name_slug = 'wp-tawk-to-integrator-settings'; // Matches the menu slug

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
            require_once __DIR__ . '/partials/page-header.php'
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
                <?php

                require_once __DIR__ . '/partials/tabs.php';

                ?>
            </div>

            <!-- Tabs content -->
            <div id="tabs-content-wrapper" class="space-y-6">
                <?php
                // Load the correct partial file
                require_once __DIR__ . '/partials/tab-integration.php';

                require_once __DIR__ . '/partials/tab-appearance.php';

                require_once __DIR__ . '/partials/tab-behavior.php';

                require_once __DIR__ . '/partials/tab-events.php';

                require_once __DIR__ . '/partials/tab-pro.php';

                ?>
            </div>


            <!-- Active tab (invisible field) -->
            <input type="hidden" name="wp-tawk-to-integrator_options[tab-active]" id="tab-active" value="<?php echo isset($options['tab-active']) ? esc_attr($options['tab-active']) : 'Integration' ?>">

            <!-- Form submission -->
            <div class="pt-4">
                <button
                    id="form-submit-btn"
                    class="bg-mint-2 hover:bg-sea-green focus:ring-mint-2 rounded-md px-6 py-2 font-semibold text-white focus:ring-2 focus:ring-offset-2 focus:outline-none"
                    type="submit">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Alert box -->
<div id="custom-alert-overlay" class="hidden"></div>
<div id="custom-alert-box" class="hidden"></div>