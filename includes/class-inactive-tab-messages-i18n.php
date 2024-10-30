<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://igorsumonja.com/
 * @since      1.0.0
 *
 * @package    Inactive_Tab_Messages
 * @subpackage Inactive_Tab_Messages/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Inactive_Tab_Messages
 * @subpackage Inactive_Tab_Messages/includes
 * @author     Igor Šumonja <sumonja.igor@gmail.com>
 */
class Inactive_Tab_Messages_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'inactive-tab-messages',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
