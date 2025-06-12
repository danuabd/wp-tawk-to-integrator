<?php

/**
 * Provides the admin settings page view for the WP Tawk.to Integrator plugin.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    WP_Tawk_To_Integrator
 * @subpackage WP_Tawk_To_Integrator/admin/views
 */

if (! defined('WPINC')) {
    die;
}

// Get the active tab, default to 'integration'
$active_tab = isset($_GET['tab']) ? sanitize_key($_GET['tab']) : 'integration';
$plugin_name_slug = 'wp-tawk-to-integrator-settings'; // Matches the menu slug

?>
<div class="bg-gray-100 p-6 flex items-center justify-center">
    <div class="max-w-4xl rounded-lg bg-white p-8 shadow-lg">
        <?php
        // get page header
        require_once __DIR__ . '/partials/page-header.php'
        ?>
        <form action="options.php" method="post">
            <?php
            settings_fields('wp-tawk-to-integrator_options_group');
            ?>

            <div id="tabs-button-wrapper" class="mb-6"></div>

            <div id="tabs-content-wrapper" class="space-y-6">
                <?php
                // Load the correct partial file
                require_once __DIR__ . '/partials/tab-appearance.php';

                require_once __DIR__ . '/partials/tab-behavior.php';

                require_once __DIR__ . '/partials/tab-events.php';

                require_once __DIR__ . '/partials/tab-pro.php';

                require_once __DIR__ . '/partials/tab-integration.php';
                ?>
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
        </form>
    </div>
</div>

<?php

// Moved the save button outside the conditional block
// so it appears on every tab, which is better UX.
// submit_button(__('Save Settings', 'wp-tawk-to-integrator'));

?>