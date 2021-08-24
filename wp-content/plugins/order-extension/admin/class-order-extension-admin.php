<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       Anuj Patel
 * @since      1.0.0
 *
 * @package    Order_Extension
 * @subpackage Order_Extension/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Order_Extension
 * @subpackage Order_Extension/admin
 * @author     Anuj Patel <patelanuj2612@gmail.com>
 */
class Order_Extension_Admin {

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

        private $screen_type = '';
        
        private $orderIds = [];
        
	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Order_Extension_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Order_Extension_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/order-extension-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Order_Extension_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Order_Extension_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/order-extension-admin.js', array( 'jquery' ), $this->version, false );
	}
        
        public function get_current_screen(){
            $screen_id = get_current_screen();
            $this->screen_type = $screen_id->id;
        }
        
       public function custom_js_to_head() {
           if(!empty($this->screen_type) && $this->screen_type == 'shop_order'){
                global $post;
                $query = new WC_Order_Query( array(
                    'return' => 'ids',
                    'order' => 'ASC'
                ));
                $this->orderIds = $query->get_orders();
//                var_dump($this->orderIds);exit;
                $totalOrders = count($this->orderIds); 
                for($i=0;$i < $totalOrders;$i++){
                    if($this->orderIds[$i] == $post->ID){
                        $j = $i-1;
                        $k = $i+1;
                        $prevOrderId = ($j >= 0) ? $this->orderIds[$j] : '';
                        $nextOrderId = ($k < $totalOrders) ? $this->orderIds[$k] : '';
                        break;
                    }
                }
                $prevOrderlink = !empty($prevOrderId) ? admin_url('post.php?post='.$prevOrderId.'&action=edit') : '';
                $nextOrderlink = !empty($nextOrderId) ? admin_url('post.php?post='.$nextOrderId.'&action=edit') : '';
            }
           
    ?>
    <script>
    jQuery(function(){
        <?php if(!empty($prevOrderlink)) { ?>
            jQuery("body.post-type-shop_order .wrap .page-title-action").after('<a href="<?php echo $prevOrderlink; ?>" class="page-title-action prev">Prev Order</a>');
       <?php } ?>
        <?php if(!empty($nextOrderlink)) { ?>
            var flag = jQuery("body.post-type-shop_order .wrap ").find(".page-title-action").eq(1).hasClass('prev');
            var className = (flag) ? ".prev" : "";
            jQuery("body.post-type-shop_order .wrap .page-title-action"+(className)).after('<a href="<?php echo $nextOrderlink; ?>" class="page-title-action">Next Order</a>');
       <?php } ?>
    });
    </script>
    <?php
}

}
