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
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
    <p><?php esc_html_e('Configure your Tawk.to chat widget integration, appearance, behavior, and more.', 'wp-tawk-to-integrator'); ?></p>

    <h2 class="nav-tab-wrapper">
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=integration" class="nav-tab <?php echo $active_tab == 'integration' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Integration', 'wp-tawk-to-integrator'); ?>
        </a>
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=appearance" class="nav-tab <?php echo $active_tab == 'appearance' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Appearance', 'wp-tawk-to-integrator'); ?>
        </a>
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=behavior" class="nav-tab <?php echo $active_tab == 'behavior' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Behavior', 'wp-tawk-to-integrator'); ?>
        </a>
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=events" class="nav-tab <?php echo $active_tab == 'events' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Events', 'wp-tawk-to-integrator'); ?>
        </a>
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=pro" class="nav-tab <?php echo $active_tab == 'pro' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e('Pro', 'wp-tawk-to-integrator'); ?>
        </a>
    </h2>

    <form action="options.php" method="post">
        <?php
        settings_fields('wp-tawk-to-integrator_options_group');
        ?>

        <div class="tab-content" style="padding-top: 20px;">
            <?php
            // Use a switch statement to load the correct partial file
            switch ($active_tab) {
                case 'appearance':
                    require_once __DIR__ . '/partials/tab-appearance.php';
                    break;
                case 'behavior':
                    require_once __DIR__ . '/partials/tab-behavior.php';
                    break;
                case 'events':
                    require_once __DIR__ . '/partials/tab-events.php';
                    break;
                case 'pro':
                    require_once __DIR__ . '/partials/tab-pro.php';
                    break;
                case 'integration':
                default:
                    require_once __DIR__ . '/partials/tab-integration.php';
                    break;
            }
            ?>
        </div>

        <?php
        // Moved the save button outside the conditional block
        // so it appears on every tab, which is better UX.
        submit_button(__('Save Settings', 'wp-tawk-to-integrator'));
        ?>
    </form>
</div>