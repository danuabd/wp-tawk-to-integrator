# WP Tawk.to Integrator

- **Contributors:** ABD Prasad (danukaprasad.com)
- **Tags:** tawkto, tawk.to, chat, live chat, widget
- **Requires at least:** 5.0
- **Tested up to:** 6.4
- **Requires PHP:** 8.0
- **Stable tag:** 1.0.0
- **License:** GPL-3.0
- **License URI:** https://www.gnu.org/licenses/gpl-3.0.en.html

Add Tawk.to chat widget to your WordPress website and customize it the way you want.

## Description

WP Tawk.to Integrator allows you to easily integrate the Tawk.to live chat widget into your WordPress website. It provides a settings page to manage your Tawk.to Property ID and Widget ID, and offers a foundation for future customizations related to appearance, behavior, and event handling.

This plugin is structured to be extensible and follows WordPress plugin development best practices.

## Installation

1.  Upload the `wp-tawk-to-integrator` folder to the `/wp-content/plugins/` directory.
2.  Activate the plugin through the 'Plugins' menu in WordPress.
3.  Go to "Configure Tawk.to Chat Widget" in the WordPress admin menu to set up your Tawk.to Property ID and Widget ID (actual fields for these IDs will be added in a future version).

## Frequently Asked Questions

*   **Where do I find my Tawk.to Property ID and Widget ID?**
    You can find these in your Tawk.to dashboard. (Details to be added once settings fields are implemented).

## Changelog

### 1.0.0 - 2023-12-08
*   Initial release. Basic plugin structure, admin settings page with tabs, and placeholder for Tawk.to widget integration.


*   `/languages`: For translation files (`.pot`, `.po`, `.mo`). The text domain is `wp-tawk-to-integrator`.
*   `index.php` files are included in each directory to prevent direct browsing.

## Plugin Features

The Tawk.to Integrator plugin provides robust functionality for integrating and customizing the Tawk.to chat widget on your WordPress site. Key features include:

* **Core Integration:** Handles the foundational setup and initialization of the Tawk.to widget, including defining essential constants and hooks for seamless operation.
* **Admin Dashboard:** Offers a dedicated WordPress admin interface for managing plugin settings. This includes registration of settings and control over overall admin-side logic through organized view files.
* **Front-End Widget Display:** Manages the public-facing display of the Tawk.to chat widget, ensuring it is correctly embedded and interacts as expected on your website.
* **Extensible Architecture:** Designed with an `includes` directory for shared libraries, core functionalities, and helper functions, facilitating future expansions and custom development.

### Planned Updates for the Future

The plugin is continuously evolving with exciting new features planned to enhance its capabilities:

* **Advanced Visitor Information:** Future updates will enable passing custom attributes about logged-in WordPress users directly to Tawk.to, allowing for more personalized and informed chat interactions.
* **Enhanced Tagging Features:**
    * **Action-Based Tagging:** Users will be able to define rules to automatically apply specific tags to visitors when they click on designated elements on your site.
    * **Automatic Page Tagging Enhancements:** Improved control over which pages are excluded from automatic tagging.
* **Custom JavaScript API Event Actions:** Upcoming features will allow users to leverage Tawk.to's JavaScript API events for custom scripts, including:
    * **`onChatStarted` / `onChatEnded` Events:** Execute custom code when a chat session begins or ends.
    * **`onPrechatSubmit` Events:** Run custom scripts when the pre-chat form is submitted, with access to the submitted data.
* **Pro Version Features:** A future Pro version will unlock advanced functionalities such as webhook integrations (e.g., Zapier), deeper WooCommerce and Easy Digital Downloads integration, customizable chat widget styling presets, and priority support.
