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

if ( ! defined( 'WPINC' ) ) {
    die;
}

// Get the active tab, default to 'integration'
$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'integration';
$plugin_name_slug = 'wp-tawk-to-integrator-settings'; // Matches the menu slug

?>
<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <p><?php esc_html_e( 'Configure your Tawk.to chat widget integration, appearance, behavior, and more.', 'wp-tawk-to-integrator' ); ?></p>

    <h2 class="nav-tab-wrapper">
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=integration" class="nav-tab <?php echo $active_tab == 'integration' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e( 'Integration', 'wp-tawk-to-integrator' ); ?>
        </a>
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=appearance" class="nav-tab <?php echo $active_tab == 'appearance' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e( 'Appearance', 'wp-tawk-to-integrator' ); ?>
        </a>
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=behavior" class="nav-tab <?php echo $active_tab == 'behavior' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e( 'Behavior', 'wp-tawk-to-integrator' ); ?>
        </a>
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=events" class="nav-tab <?php echo $active_tab == 'events' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e( 'Events', 'wp-tawk-to-integrator' ); ?>
        </a>
        <a href="?page=<?php echo esc_attr($plugin_name_slug); ?>&tab=pro" class="nav-tab <?php echo $active_tab == 'pro' ? 'nav-tab-active' : ''; ?>">
            <?php esc_html_e( 'Pro', 'wp-tawk-to-integrator' ); ?>
        </a>
    </h2>

    <form action="options.php" method="post">
        <?php
        // Output security fields for the registered setting group.
        settings_fields( 'wp-tawk-to-integrator_options_group' ); // Matches the group name in WP_Tawk_To_Integrator_Admin::register_settings()
        ?>
        <div class="tab-content">
            <?php if ( $active_tab == 'integration' ) : ?>
                <h2><?php esc_html_e( 'Integration Settings', 'wp-tawk-to-integrator' ); ?></h2>
                <p><?php esc_html_e( 'Settings related to Tawk.to account integration (e.g., Property ID, Widget ID) will go here.', 'wp-tawk-to-integrator' ); ?></p>
                <?php
                // Display settings for this tab
                // In a real scenario, you might have different sections per tab
                // or call do_settings_sections for a specific page slug if you structured it that way.
                // For this example, we'll display the general section which contains our example field.
                do_settings_sections( $plugin_name_slug ); // Displays sections added to 'wp-tawk-to-integrator-settings' page
                ?>
            <?php elseif ( $active_tab == 'appearance' ) : ?>
                <h2><?php esc_html_e( 'Appearance Settings', 'wp-tawk-to-integrator' ); ?></h2>
                <p><?php esc_html_e( 'Customize the look and feel of your Tawk.to chat widget.', 'wp-tawk-to-integrator' ); ?></p>
                <p><em><?php esc_html_e( 'Example fields for colors, positions, etc., would go here, registered via Settings API.', 'wp-tawk-to-integrator' ); ?></em></p>
            <?php elseif ( $active_tab == 'behavior' ) : ?>
                <h2><?php esc_html_e( 'Behavior Settings', 'wp-tawk-to-integrator' ); ?></h2>
                <p><?php esc_html_e( 'Control how the chat widget behaves on your site (e.g., visibility, triggers).', 'wp-tawk-to-integrator' ); ?></p>
                <p><em><?php esc_html_e( 'Example fields for page visibility, auto-open rules, etc., would go here.', 'wp-tawk-to-integrator' ); ?></em></p>
            <?php elseif ( $active_tab == 'events' ) : ?>
                <h2><?php esc_html_e( 'Events API Settings', 'wp-tawk-to-integrator' ); ?></h2>
                <p><?php esc_html_e( 'Configure JavaScript events for advanced interactions with the Tawk.to widget.', 'wp-tawk-to-integrator' ); ?></p>
                <p><em><?php esc_html_e( 'Fields for enabling/disabling specific JS API events or callbacks would go here.', 'wp-tawk-to-integrator' ); ?></em></p>
            <?php elseif ( $active_tab == 'pro' ) : ?>
                <h2><?php esc_html_e( 'Pro Features', 'wp-tawk-to-integrator' ); ?></h2>
                <p><?php esc_html_e( 'Information about premium features or add-ons.', 'wp-tawk-to-integrator' ); ?></p>
                <p><em><?php esc_html_e( 'This tab could link to a Pro version or showcase unavailable features.', 'wp-tawk-to-integrator' ); ?></em></p>
            <?php endif; ?>
        </div>
        <?php
        // Output save settings button
        // Only show submit button if there are settings registered for the current view.
        // For simplicity, we show it on the 'integration' tab as it has the example field.
        if ( $active_tab == 'integration' ) {
            submit_button( __( 'Save Settings', 'wp-tawk-to-integrator' ) );
        }
        ?>
    </form>
</div>
```
