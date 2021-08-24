<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Wpajaxify
 * @subpackage Wpajaxify/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wpajaxify
 * @subpackage Wpajaxify/public
 * @author     Anuj Patel <patelanuj2612@gmail.com>
 */
class Wpajaxify_Public {

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
    protected $action_name;
    private $nonce;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version, $action_name) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->action_name = $action_name;
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
         * defined in Wpajaxify_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Wpajaxify_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->action_name, plugin_dir_url(__FILE__) . 'js/' . $this->action_name . '.js', array('jquery'), $this->version, false);
        wp_localize_script($this->action_name, "{$this->action_name}Object", array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            '_ajax_nonce' => $this->nonce,
            'action' => $this->action_name,
        ));
    }
    
    public function create_nonce() {
        $this->nonce = wp_create_nonce("{$this->action_name}_action");
    }
    
    public function ajax_handle_wpajaxify(){
        check_ajax_referer( "{$this->action_name}_action");
//        wp_send_json_error('Science failed...');
        //wp_send_json_success('Science achieved!');
        wp_send_json(array(
            'code' => '200',
            'message' => 'hello'
        ));
    }
    
    public function ajax_handle_test(){
        check_ajax_referer( "{$this->action_name}_action");
//        wp_send_json_error('Science failed...');
        //wp_send_json_success('Science achieved!');
        wp_send_json(array(
            'code' => '200',
            'message' => 'hello'
        ));
    }

}
