<?php

/**
 * Fired during plugin activation
 *
 * @link       Anuj Patel
 * @since      1.0.0
 *
 * @package    Order_Extension
 * @subpackage Order_Extension/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Order_Extension
 * @subpackage Order_Extension/includes
 * @author     Anuj Patel <patelanuj2612@gmail.com>
 */
class Order_Extension_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {
        // Require parent plugin
        if (!is_plugin_active('woocommerce/woocommerce.php') && current_user_can('activate_plugins')) {
            // Stop activation redirect and show error
            wp_die('Sorry, but this plugin requires the Woocommerce Plugin to be installed and active. <br><a href="' . admin_url('plugins.php') . '">&laquo; Return to Plugins</a>');
        }
    }

}
