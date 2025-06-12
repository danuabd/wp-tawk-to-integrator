<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    WP_Tawk_To_Integrator
 * @subpackage WP_Tawk_To_Integrator/admin
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

class WP_Tawk_To_Integrator_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param    string    $plugin_name       The name of this plugin.
     * @param    string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_admin_menu() {
        add_menu_page(
            __( 'Configure Tawk.to Chat Widget', 'wp-tawk-to-integrator' ), // Page Title
            __( 'Configure Tawk.to Chat Widget', 'wp-tawk-to-integrator' ), // Menu Title
            'manage_options',                               // Capability
            $this->plugin_name . '-settings',               // Menu Slug
            array( $this, 'display_settings_page' ),        // Callback function
            'dashicons-format-chat'                         // Icon
        );
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_settings_page() {
        // Check if the user has permissions to access this page
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }
        // Include the settings page view
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/views/settings-page.php';
    }

    /**
     * Register the settings for this plugin.
     *
     * @since 1.0.0
     */
    public function register_settings() {
        register_setting(
            $this->plugin_name . '_options_group', // Option group
            $this->plugin_name . '_options',       // Option name
            array( $this, 'sanitize_options' )     // Sanitize callback
        );

        // Add a general section (optional, but good for structure)
        add_settings_section(
            $this->plugin_name . '_general_section',        // ID
            __( 'General Settings', 'wp-tawk-to-integrator' ), // Title
            array( $this, 'general_section_callback' ), // Callback
            $this->plugin_name . '-settings'                // Page slug where to display
        );

        // Example field (we'll add more specific fields per tab later)
        add_settings_field(
            'example_text_field',                           // ID
            __( 'Example Text Field', 'wp-tawk-to-integrator' ), // Title
            array( $this, 'example_text_field_render' ),   // Callback to render the field
            $this->plugin_name . '-settings',                // Page
            $this->plugin_name . '_general_section'        // Section
        );
    }

    /**
     * Sanitize each setting field as needed.
     *
     * @since 1.0.0
     * @param array $input Contains all settings fields as array keys
     * @return array Sanitized array of options
     */
    public function sanitize_options( $input ) {
        $sanitized_input = array();
        if ( isset( $input['example_text_field'] ) ) {
            $sanitized_input['example_text_field'] = sanitize_text_field( $input['example_text_field'] );
        }
        // Add sanitization for other fields as they are added
        return $sanitized_input;
    }

    /**
     * Callback for the general section description.
     *
     * @since 1.0.0
     */
    public function general_section_callback() {
        echo '<p>' . esc_html__( 'These are some general settings for the WP Tawk.to Integrator plugin.', 'wp-tawk-to-integrator' ) . '</p>';
    }

    /**
     * Render the example text field.
     *
     * @since 1.0.0
     */
    public function example_text_field_render() {
        $options = get_option( $this->plugin_name . '_options' );
        ?>
        <input type='text' name='<?php echo esc_attr($this->plugin_name . '_options[example_text_field]'); ?>'
               value='<?php echo isset($options['example_text_field']) ? esc_attr( $options['example_text_field'] ) : ''; ?>'>
        <?php
    }
}
?>
