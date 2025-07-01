# Easy Tawk.to Integrator

* **Contributors:** danukaprasad
* **Tags:** tawk.to chat, tawk.to chat widget, tawk.to integration, live chat, chat plugin
* **Requires at least:** 5.0
* **Tested up to:** 6.4
* **Requires PHP:** 8.0
* **Stable tag:** 1.0.0
* **License:** GPL-3.0
* **License URI:** https://www.gnu.org/licenses/gpl-3.0.en.html

Integrate Tawk.to live chat into your WordPress site with easy setup and powerful customization options.

== Description ==

The **Easy Tawk.to Integrator** plugin offers a straightforward and robust solution for adding the Tawk.to live chat widget to your WordPress website. Beyond simple integration, it provides a dedicated settings page to manage your Tawk.to **Property ID** and **Widget ID**, ensuring a seamless connection.

Designed with **extensibility** in mind, this plugin lays a solid foundation for future enhancements related to widget appearance, behavior, and event handling. It adheres to WordPress plugin development best practices, making it reliable and easy to maintain.

Key Features:

* **Core Tawk.to Widget Integration:** Handles the foundational setup and initialization of the Tawk.to widget, including defining essential constants and hooks for seamless operation.
* **Intuitive Admin Dashboard:** Offers a dedicated WordPress admin interface for managing plugin settings, including organized view files for overall admin-side logic.
* **Seamless Front-End Widget Display:** Manages the public-facing display of the Tawk.to chat widget, ensuring it is correctly embedded and interacts as expected on your website.
* **Extensible Architecture:** Designed with an `includes` directory for shared libraries, core functionalities, and helper functions, facilitating future expansions and custom development.

== Installation ==

1.  **Upload:** Upload the `easy-tawk-to-integrator` folder to the `/wp-content/plugins/` directory.
2.  **Activate:** Activate the plugin through the 'Plugins' menu in your WordPress dashboard.
3.  **Configure:** Go to "**Configure Tawk.to Chat Widget**" in the WordPress admin menu (under "Settings" or a custom top-level menu item) to set up your Tawk.to Property ID and Widget ID.

== Frequently Asked Questions ==

= Where do I find my Tawk.to Property ID and Widget ID? =

You can find these IDs in your Tawk.to dashboard. After logging in, navigate to **Admin -> Property -> Chat Widget**. Your Property ID and Widget ID will be displayed there.

== Changelog ==

= 1.0.0 - 2023-12-08 =
* Initial release of the plugin.
* Basic plugin structure established.
* Admin settings page with tabs implemented.
* Placeholder for Tawk.to widget integration.

== Upgrade Notice ==

= 1.0.0 =
This is the initial release. No upgrade notice is required.

== Planned Updates for the Future ==

The **Easy Tawk.to Integrator** plugin is continuously evolving with exciting new features planned to enhance its capabilities:

* **Advanced Visitor Information:** Future updates will enable passing custom attributes about logged-in WordPress users directly to Tawk.to, allowing for more personalized and informed chat interactions.
* **Enhanced Tagging Features:**
    * **Action-Based Tagging:** Users will be able to define rules to automatically apply specific tags to visitors when they click on designated elements on your site.
    * **Automatic Page Tagging Enhancements:** Improved control over which pages are excluded from automatic tagging.
* **Custom JavaScript API Event Actions:** Upcoming features will allow users to leverage Tawk.to's JavaScript API events for custom scripts, including:
    * `onChatStarted` / `onChatEnded` Events: Execute custom code when a chat session begins or ends.
    * `onPrechatSubmit` Events: Run custom scripts when the pre-chat form is submitted, with access to the submitted data.
* **Pro Version Features:** A future Pro version will unlock advanced functionalities such as webhook integrations (e.g., Zapier), deeper WooCommerce and Easy Digital Downloads integration, customizable chat widget styling presets, and priority support.