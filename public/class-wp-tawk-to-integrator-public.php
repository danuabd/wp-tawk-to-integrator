<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://danukaprasad.com
 * @since      1.0.0
 *
 * @package    Wp_Tawk_To_Integrator
 * @subpackage Wp_Tawk_To_Integrator/public
 * @author     ABD Prasad <contact@danukaprasad.com>
 */

require_once WP_TAWK_TO_INTEGRATOR_PLUGIN_DIR . 'includes/wp-tawk-to-integrator-config.php';

class Wp_Tawk_To_Integrator_Public
{

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
	 * The options of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $options    The stored options of this plugin.
	 */
	private $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{

		$this->plugin_name = Wp_Tawk_To_Integrator_Config::get_plugin_name();
		$this->version = Wp_Tawk_To_Integrator_Config::get_plugin_version();
		$this->options = get_option(Wp_Tawk_To_Integrator_Config::get_option_name());
	}

	/**
	 * Embed the Tawk.to chat widget script and configuration in the footer.
	 * This function is hooked to 'wp_footer'.
	 *
	 * @since    1.0.0
	 */
	public function embed_tawk_to_widget()
	{

		// --- Step 1: Guard Clauses - Check if we should show the widget at all ---

		// Is the widget globally disabled?
		if (empty($this->options['activate_widget'])) {
			return; // Do nothing.
		}

		// Are the required IDs missing?
		$property_id = isset($this->options['property_id']) ? $this->options['property_id'] : '';
		$widget_id   = isset($this->options['widget_id']) ? $this->options['widget_id'] : '';
		if (empty($property_id) || empty($widget_id)) {
			echo "";
			return;
		}

		// Should we hide on this specific page?
		$pages_to_hide_str = isset($this->options['pages_to_hide']) ? $this->options['pages_to_hide'] : '';
		if (! empty($pages_to_hide_str)) {
			$pages_to_hide = array_map('trim', explode(',', $pages_to_hide_str));
			if (is_page($pages_to_hide) || is_single($pages_to_hide)) {
				return; // Do not show on this page.
			}
		}

		// Should we hide based on user role?
		$current_user = wp_get_current_user();
		if (is_user_logged_in()) {
			$user_roles = (array) $current_user->roles;
			foreach ($user_roles as $role) {
				$option_key = 'hide_widget_' . $role . '_role';
				if (! empty($this->options[$option_key])) {
					return; // Hide for this user role.
				}
			}
		} else {
			// User is a guest (not logged in).
			if (empty($this->options['show_widget_to_guest'])) {
				return; // Do not show for guests.
			}
		}

		// --- Step 2: If all checks pass, build the scripts ---

		$this->render_main_widget_script($property_id, $widget_id);
		$this->render_api_configuration_script($current_user);
	}

	/**
	 * Renders the main Tawk.to embed script.
	 */
	private function render_main_widget_script($property_id, $widget_id)
	{
		$z_index = isset($this->options['z_index']) && $this->options['z_index'] ? absint($this->options['z_index']) : 'auto';
?>
		<script type="text/javascript">
			var Tawk_API = Tawk_API || {};
			<?php if ($z_index !== 'auto') : ?>
				Tawk_API.customStyle = {
					zIndex: <?php echo $z_index; ?>
				};
			<?php endif; ?>
			var Tawk_LoadStart = new Date();
			(function() {
				var s1 = document.createElement("script"),
					s0 = document.getElementsByTagName("script")[0];
				s1.async = true;
				s1.src = 'https://embed.tawk.to/<?php echo esc_js($property_id); ?>/<?php echo esc_js($widget_id); ?>';
				s1.charset = 'UTF-8';
				s1.setAttribute('crossorigin', '*');
				s0.parentNode.insertBefore(s1, s0);
			})();
		</script>
	<?php
	}

	/**
	 * Renders the Tawk.to JavaScript API configuration script.
	 */
	private function render_api_configuration_script($current_user)
	{
	?>
		<script type="text/javascript">
			Tawk_API = Tawk_API || {};

			Tawk_API.onLoad = function() {
				// This function runs once the widget is loaded.

				<?php
				// --- BEHAVIOR TAB: Maximize on element click ---
				$maximize_selector = isset($this->options['widget_maximize_element']) ? $this->options['widget_maximize_element'] : '';
				if (! empty($maximize_selector)) :
				?>
					document.querySelectorAll('<?php echo esc_js($maximize_selector); ?>').forEach(function(element) {
						element.addEventListener('click', function(e) {
							e.preventDefault();
							Tawk_API.maximize();
						});
					});
				<?php endif; ?>
			};

			<?php if (is_user_logged_in()) : ?>
				<?php
				// --- BEHAVIOR TAB: Secure Mode ---
				$api_key = isset($this->options['tawk_api_key']) ? $this->options['tawk_api_key'] : '';
				if (! empty($this->options['secure_mode']) && ! empty($api_key)) :
					$hash = hash_hmac("sha256", $current_user->user_email, $api_key);
				?>
					Tawk_API.visitor = {
						name: '<?php echo esc_js($current_user->display_name); ?>',
						email: '<?php echo esc_js($current_user->user_email); ?>',
						hash: '<?php echo esc_js($hash); ?>'
					};
				<?php
				// --- BEHAVIOR TAB: Auto-populate user data (if secure mode is off) ---
				elseif (! empty($this->options['auto_populate_userdata'])) :
				?>
					Tawk_API.visitor = {
						name: '<?php echo esc_js($current_user->display_name); ?>',
						email: '<?php echo esc_js($current_user->user_email); ?>'
					};
				<?php endif; ?>


				<?php
				// --- BEHAVIOR TAB: Custom Attributes ---
				$custom_attributes_str = isset($this->options['custom_attributes']) ? $this->options['custom_attributes'] : '';
				if (! empty($custom_attributes_str)) :
					$attributes = array();
					$pairs = explode(',', $custom_attributes_str);
					foreach ($pairs as $pair) {
						$kv = explode(':', $pair, 2);
						if (count($kv) === 2 && trim($kv[0]) && trim($kv[1])) {
							$attributes[trim($kv[0])] = trim($kv[1]);
						}
					}
					if (! empty($attributes)) :
				?>
						Tawk_API.setAttributes(<?php echo wp_json_encode($attributes); ?>, function(error) {
							if (error) {
								console.error('Tawk.to Integrator: Could not set custom attributes.');
							}
						});
				<?php
					endif;
				endif;
				?>
			<?php endif; // End is_user_logged_in() check 
			?>
		</script>
<?php
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {}
}
