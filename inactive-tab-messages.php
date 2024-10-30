<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://igorsumonja.com/
 * @since             1.0.0
 * @package           Inactive_Tab_Messages
 *
 * @wordpress-plugin
 * Plugin Name:       Inactive Tab Messages
 * Description:       Add custom message to browser tab if user click away to another tab.
 * Version:           1.0.0
 * Author:            Igor Šumonja
 * Author URI:        https://igorsumonja.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       inactive-tab-messages
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'INACTIVE_TAB_MESSAGES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-inactive-tab-messages-activator.php
 */
function activate_inactive_tab_messages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inactive-tab-messages-activator.php';
	Inactive_Tab_Messages_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-inactive-tab-messages-deactivator.php
 */
function deactivate_inactive_tab_messages() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inactive-tab-messages-deactivator.php';
	Inactive_Tab_Messages_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_inactive_tab_messages' );
register_deactivation_hook( __FILE__, 'deactivate_inactive_tab_messages' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-inactive-tab-messages.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_inactive_tab_messages() {

	$plugin = new Inactive_Tab_Messages();
	$plugin->run();

}
run_inactive_tab_messages();
