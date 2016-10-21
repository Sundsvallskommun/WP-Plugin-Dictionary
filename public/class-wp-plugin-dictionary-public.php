<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://cybercom.com
 * @since      1.0.0
 *
 * @package    Wp_Plugin_Dictionary
 * @subpackage Wp_Plugin_Dictionary/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Plugin_Dictionary
 * @subpackage Wp_Plugin_Dictionary/public
 * @author     Andreas Färnstrand <andreas.farnstrand@cybercom.com>
 */
class Wp_Plugin_Dictionary_Public {

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
	 * @var      string    $version    The current version of this plugin.
	 */
	private $options;

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
		$this->options = get_option( 'wp_plugin_dictionary_options' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if ( $this->tether() )
			wp_enqueue_style( 'wp-plugin-dictionary-tether-css', plugin_dir_url( __FILE__ ) . 'css/tether.min.css', array(), $this->version, 'all' );

		if ( $this->bootstrap() )
			wp_enqueue_style( 'wp-plugin-dictionary-bootstrap-css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-plugin-dictionary-public.css', array(), $this->version, 'all' );

	}


	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if( $this->tether() )
			wp_enqueue_script( 'wp-plugin-dictionary-tether-js', plugin_dir_url( __FILE__ ) . 'js/tether.min.js', array(), $this->version, false );

		if( $this->bootstrap() )
			wp_enqueue_script( 'wp-plugin-dictionary-bootstrap-js', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-plugin-dictionary-public.js', array( 'jquery' ), $this->version, false );

	}


	/**
	 * Check options if we want to load tether files
	 *
	 * @since    1.0.0
	 * @access   private
	 * @return boolean
	 */
	private function tether() {

		if ( ! $this->has_options() ) return false;
		if ( empty( $this->options['wp_plugin_dictionary_field_tether'] ) ) return false;
		if ( $this->options['wp_plugin_dictionary_field_tether'] === 'false' ) return false;

		return true;

	}


	/**
	 * Check options if we want to load bootstrap files
	 *
	 * @since    1.0.0
	 * @access   private
	 * @return boolean
	 */
	private function bootstrap() {

		if ( ! $this->has_options() ) return false;
		if ( empty( $this->options['wp_plugin_dictionary_field_bootstrap'] ) ) return false;
		if ( $this->options['wp_plugin_dictionary_field_bootstrap'] === 'false' ) return false;

		return true;

	}


	/**
	 * Check if plugin has options stored
	 *
	 * @since    1.0.0
	 * @access   private
	 * @return boolean
	 */
	private function has_options() {

		if( ! empty( $this->options ) && is_array( $this->options ) ) return true;
		return false;

	}

}
