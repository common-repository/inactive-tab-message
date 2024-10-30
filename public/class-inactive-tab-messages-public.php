<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://igorsumonja.com/
 * @since      1.0.0
 *
 * @package    Inactive_Tab_Messages
 * @subpackage Inactive_Tab_Messages/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Inactive_Tab_Messages
 * @subpackage Inactive_Tab_Messages/public
 * @author     Igor Šumonja <sumonja.igor@gmail.com>
 */
class Inactive_Tab_Messages_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Inactive_Tab_Messages_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Inactive_Tab_Messages_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/inactive-tab-messages-public.js', array(), $this->version, true );
		wp_localize_script( $this->plugin_name, 'inactiveTabMessages', get_option($this->plugin_name ) );

	}

}
