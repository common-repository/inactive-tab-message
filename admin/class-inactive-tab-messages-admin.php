<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://igorsumonja.com/
 * @since      1.0.0
 *
 * @package    Inactive_Tab_Messages
 * @subpackage Inactive_Tab_Messages/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inactive_Tab_Messages
 * @subpackage Inactive_Tab_Messages/admin
 * @author     Igor Šumonja <sumonja.igor@gmail.com>
 */
class Inactive_Tab_Messages_Admin {

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
	 * The main options ( array ) to be used in this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $options     Options array
	 */
	private $options;

	/**
	 * The main menu page for this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $options     Options array
	 */
	private $menupage;

	/**
	 * The main options name ( array ) to be used in this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $fields     Option name of this plugin
	 */
	private $fields = [];

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version           The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->options     = get_option( $this->plugin_name );
		if ( ! $this->options ) {
			update_option( $this->plugin_name, $this->get_default_options() );
		}

		$this->menupage = [
			'page_title' => __( 'Inactive Tab Messages', 'inactive-tab-messages' ),
			'menu_title' => __( 'Inactive Tab Messages', 'inactive-tab-messages' ),
			'slug'       => $this->plugin_name,
		];

	}

	/**
	 * Get default options for settings
	 *
	 * @since    1.0.0
	 */
	public function get_default_options() {

		$options = [];

		$fields = $this->get_settings_fields();

		foreach ( $fields as $field ) {

			$options[ $field['uid'] ] = $field['default'];
		}

		return $options;

	}

	/**
	 * Add settings and fields
	 *
	 * @since    1.0.0
	 */
	public function add_settings() {

		register_setting( $this->menupage['slug'], $this->plugin_name );

		$setting_sections = $this->get_settings_sections();

		$this->add_setting_sections( $setting_sections );

		$fields = $this->get_settings_fields();

		foreach ( $fields as $field ) {
			add_settings_field(
				$field['uid'],
				$field['label'],
				array( $this, 'field_callback' ),
				$this->menupage['slug'],
				$field['section'],
				$field
			);

		}

	}


	/**
	 * Plugin options field definitions
	 *
	 * @since    1.0.0
	 * @return    array    The array of fields definitions.
	 */
	public function get_settings_fields() {

		$fields = [
			[
				'uid'          => 'inactive',
				'label'        => __( 'Inactive Tab Label', 'inactive-tab-messages' ),
				'section'      => 'general_settings_section',
				'type'         => 'text',
				'placeholder'  => __( 'Set inactive tab label', 'inactive-tab-messages' ),
				'helper'       => '',
				'supplemental' => __( 'This label will be show when site tab is inactive', 'inactive-tab-messages' ),
				'default'      => __( 'Come back', 'inactive-tab-messages' ),
			],

		];

		return $fields;

	}

	/**
	 * Plugin settings sections fields
	 *
	 * @since    1.0.0
	 * @return    array    The array of settings sections definitions.
	 */
	public function get_settings_sections() {

		$setting_sections = [
			[
				'name'          => 'general_settings_section',
				'title'         => __( 'Inactive Tab Messages', 'inactive-tab-messages' ),
				'callback'      => array( $this, 'section_callback' ),
				'settings_page' => $this->menupage['slug'],
			],
		];

		return $setting_sections;

	}

	/**
	 * Add settings page
	 *
	 * @since    1.0.0
	 * @param    array $setting_sections   The array of sections.
	 */
	public function add_setting_sections( $setting_sections ) {

		foreach ( $setting_sections as $section ) {

			add_settings_section(
				$section['name'],
				$section['title'],
				$section['callback'],
				$section['settings_page']
			);

			register_setting( $this->menupage['slug'], $section['name'] );

		}

	}

	/**
	 * Render fields callback
	 *
	 * @since    1.0.0
	 * @param    array $arguments  The array of arguments.
	 */
	public function field_callback( $arguments ) {

		$options    = $this->options;
		$value      = ( array_key_exists( $arguments['uid'], $options ) ) ? $options[ $arguments['uid'] ] : $arguments['default'];
		$field_name = $this->plugin_name . '[' . $arguments['uid'] . ']';


		switch ( $arguments['type'] ) {
			case 'text': // If it is a text field.
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', esc_attr( $field_name ), esc_attr( $arguments['type'] ), esc_attr( $arguments['placeholder'] ), esc_attr( $value ) );
				break;
			case 'textarea': // If it is a textarea.
				printf( '<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', esc_attr( $field_name ), esc_attr( $arguments['placeholder'] ), esc_html( $value ) );
				break;
			case 'select': // If it is a select dropdown.
				$allowed_html = [
					'option' => [
						'value'    => [],
						'selected' => [],
					],
				];

				if ( ! empty( $arguments['options'] ) && is_array( $arguments['options'] ) ) {
					$options_markup = '';
					foreach ( $arguments['options'] as $key => $label ) {
						$options_markup .= sprintf( '<option value="%s" %s>%s</option>', esc_attr( $key ), selected( esc_attr( $value ), esc_attr( $key ), false ), esc_html( $label ) );
					}
					printf( '<select name="%1$s" id="%1$s">%2$s</select>', esc_attr( $field_name ), wp_kses( $options_markup, $allowed_html ) );
				}
				break;
		}

		// If there is help text.
		$helper = $arguments['helper'];
		if ( $helper ) {
			printf( '<span class="helper"> %s</span>', esc_html( $helper ) ); // Show it.
		}

		// If there is supplemental text.
		$supplimental = $arguments['supplemental'];
		if ( $supplimental ) {
			printf( '<p class="description">%s</p>', esc_html( $supplimental ) ); // Show it.
		}
	}

	/**
	 * Render section callback
	 *
	 * @since    1.0.0
	 * @param    array $arguments  The array of arguments.
	 */
	public function section_callback( $arguments ) {

		switch ( $arguments['id'] ) {

			// Here you can place different description based on name of settings section.
			case 'general_settings_section':
				esc_html_e( 'Here you can setup general options for this plugin', 'inactive-tab-messages' );
				break;
			default:
				esc_html_e( 'Please set values for options:', 'inactive-tab-messages' );

		}
	}


	/**
	 * Add an options page for plugin
	 *
	 * @since    1.0.0
	 */
	public function add_options_page() {

		add_submenu_page(
			'tools.php',
			$this->menupage['page_title'],
			$this->menupage['menu_title'],
			'manage_options',
			$this->menupage['slug'],
			array( $this, 'render_options_page' )
		);

	}

	/**
	 * Render options page content
	 *
	 * @since    1.0.0
	 */
	public function render_options_page() {

		require_once plugin_dir_path( __FILE__ ) . 'partials/inactive-tab-messages-admin-display.php';

	}





}
