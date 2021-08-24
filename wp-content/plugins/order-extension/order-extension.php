<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              Anuj Patel
 * @since             1.0.0
 * @package           Order_Extension
 *
 * @wordpress-plugin
 * Plugin Name:       Order Extension
 * Plugin URI:        Order-extension
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Anuj Patel
 * Author URI:        Anuj Patel
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       order-extension
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
if (! in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
    
} 
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ORDER_EXTENSION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-order-extension-activator.php
 */
function activate_order_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-order-extension-activator.php';
	Order_Extension_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-order-extension-deactivator.php
 */
function deactivate_order_extension() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-order-extension-deactivator.php';
	Order_Extension_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_order_extension' );
register_deactivation_hook( __FILE__, 'deactivate_order_extension' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-order-extension.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_order_extension() {

	$plugin = new Order_Extension();
	$plugin->run();

}
run_order_extension();

