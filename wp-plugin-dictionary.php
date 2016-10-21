<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://cybercom.com
 * @since             1.0.0
 * @package           Wp_Plugin_Dictionary
 *
 * @wordpress-plugin
 * Plugin Name:       Sundsvall Kommun - Dictionary
 * Plugin URI:        https://github.com/Sundsvallskommun/WP-Plugin-Dictionary
 * Description:       The plugin adds dictionary support in post content. It adds a tooltip text to dictionary words via a shortcode.
 * Version:           1.0.0
 * Author:            Andreas Färnstrand
 * Author URI:        http://cybercom.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-plugin-dictionary
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-plugin-dictionary-activator.php
 */
function activate_wp_plugin_dictionary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-dictionary-activator.php';
	Wp_Plugin_Dictionary_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-plugin-dictionary-deactivator.php
 */
function deactivate_wp_plugin_dictionary() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-dictionary-deactivator.php';
	Wp_Plugin_Dictionary_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_plugin_dictionary' );
register_deactivation_hook( __FILE__, 'deactivate_wp_plugin_dictionary' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-plugin-dictionary.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_plugin_dictionary() {

	$plugin = new Wp_Plugin_Dictionary();
	$plugin->run();

}
run_wp_plugin_dictionary();
