<?php
/**
 * Plugin Name: FileItUsa Multi-Step
 * Plugin URI: https://example.com/
 * Description: Nice multi-step checkout for your WooCommerce store
 * Version: 1.0
 * Author: WP Team
 * Author URI: https://example.com
 * License: GPL2 
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}


if ( ! class_exists( 'FileItUsa_Multi_Step' ) ) :

class FileItUsa_Multi_Step{
      public function __construct(){  
          define('FIUMS_PLUGIN_URL', plugin_dir_url(__FILE__));
          define('FIUMS_PLUGIN_PATH', plugin_dir_path(__FILE__)); 

          // Enqueue: enqueue style and script 
          add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
          // Init: Add and remove woocommerce hooks
          add_action( 'init', array( $this, 'adjust_hooks' ));
          // Front: Calculate new item price and add it as custom cart item data
          add_filter('woocommerce_add_cart_item_data', array($this,'add_custom_product_data'), 10, 3);
          // Front: Set the new calculated cart item price
          add_action('woocommerce_before_calculate_totals', array($this,'extra_price_add_custom_price'), 20, 1);
          // Front: Display option in cart item
          add_filter('woocommerce_get_item_data', array($this,'display_custom_item_data'), 10, 2);
          // Save / Display custom field value as custom order item meta data
          add_action( 'woocommerce_checkout_create_order_line_item', array($this,'misha_add_order_item_meta'), 10, 4 ); 
          //service and product addon display shortcode
          add_shortcode('WP_FIUPS_shortcode', array($this, 'FIUPS_shortcode'));
          //Multistep for payment shortcode
          add_shortcode('WP_FIUMS_shortcode', array($this, 'FIUMS_shortcode'));
          //Add Dynamic page in backend
          register_activation_hook(__FILE__, array($this, 'add_custom_page_services'));
          //Remove Dynamic page in backend
          register_deactivation_hook(__FILE__, array($this, 'remove_custom_page_services'));
          // Replace the checkout template
          add_filter( 'woocommerce_locate_template', array( $this, 'woocommerce_locate_template' ), 10, 3 );

          //add custom fields to thecheckout form
          add_action( 'woocommerce_checkout_after_customer_details' , array($this, 'FIUPS_extra_checkout_fields' ));
          // Save the Data of Custom Checkout WooCommerce Fields
          add_action( 'woocommerce_checkout_update_order_meta' , array($this, 'FIUPS_save_extra_checkout_fields' ), 10, 2);
          //Display WooCommerce Admin Custom Order Fields
          add_action( 'woocommerce_admin_order_data_after_shipping_address', array($this, 'FIUPS_display_order_data_in_admin'), 10, 1);
          add_action( 'woocommerce_process_shop_order_meta', array($this, 'FIUPS_save_extra_details'), 45, 2 );






      }  
      public function adjust_hooks(){
          // Remove login messages
          //remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
          //remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

          // Split the `Order` and the `Payment` tabs
          remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 );
          remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
          add_action( 'wpmc-woocommerce_order_review', 'woocommerce_order_review', 20 );
          add_action( 'wpmc-woocommerce_checkout_payment', 'woocommerce_checkout_payment', 10 );

          // Split the `woocommerce_before_checkout_form`
          remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
          remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
          add_action( 'wpmc-woocommerce_checkout_login_form', 'woocommerce_checkout_login_form', 10 );
          add_action( 'wpmc-woocommerce_checkout_coupon_form', 'woocommerce_checkout_coupon_form', 10 );

          // Remove coupon field on the checkout page
          remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );


      }
     /**
     * Load the form-checkout.php template from this plugin
     */
      public function woocommerce_locate_template( $template, $template_name, $template_path ){
          if( 'checkout/form-checkout.php' != $template_name )
            return $template;
          $template = plugin_dir_path( __FILE__ ) . 'inc/form-checkout.php';
          return $template;
      }
      public function assets(){
          wp_enqueue_style( 'fiums-bootstrap-style', FIUMS_PLUGIN_URL . 'assets/bootstrap/css/bootstrap.min.css' );
          wp_enqueue_style( 'fiums-steps-style', FIUMS_PLUGIN_URL . 'assets/css/jquery.steps.css' );
          wp_enqueue_style( 'fiums-style', FIUMS_PLUGIN_URL . 'assets/css/fiums-styles.css' );


          wp_enqueue_script( 'fiums-bootstrap-script', FIUMS_PLUGIN_URL . 'assets/bootstrap/js/bootstrap.min.js', array('jQuery'), '1.0.0', true );
          wp_enqueue_script( 'fiums-steps-script', FIUMS_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array('jQuery'), '1.0.0', true );
          wp_enqueue_script( 'fiums-steps-script', FIUMS_PLUGIN_URL . 'assets/js/jquery.steps.js', array('jQuery'), '1.0.0', true );
          wp_enqueue_script( 'fiums-custom-script', FIUMS_PLUGIN_URL . 'assets/js/custom.js', array('jQuery'), '1.0.0', true );
      }
      public function add_custom_product_data( $cart_item_data, $product_id, $variation_id ) {   
        if (isset($_POST['repair_price']) && !empty($_POST['repair_price'])) {
              $cart_item_data['repair_price'] = (float) $_POST['repair_price'];
        }
        if (isset($_POST['mod_active_price']) && !empty($_POST['mod_active_price'])) {
          $cart_item_data['new_price'] = (float) $_POST['mod_active_price'];
              $cart_item_data['mod_active_price'] = (float) $_POST['mod_active_price'];
        }
        if (isset($_POST['sr_addon_name']) && !empty($_POST['sr_addon_name'])) {
                  $cart_item_data['sr_addon_name'] = $_POST['sr_addon_name'];
        }                                
        $cart_item_data['unique_key'] = md5(microtime().rand());
        return $cart_item_data;
      }
      public function extra_price_add_custom_price($cart) {
          if (is_admin() && !defined('DOING_AJAX'))
              return;

          if ( did_action( 'woocommerce_before_calculate_totals' ) >= 2 )
              return;

          foreach($cart->get_cart() as $cart_item) {
              if (isset($cart_item['new_price']))
                  $cart_item['data']->set_price((float) $cart_item['new_price']);
          }
      }
      public function display_custom_item_data($cart_item_data, $cart_item) {
          $sr_addon_name1 = json_decode(stripslashes($cart_item['sr_addon_name']));
           foreach ($sr_addon_name1 as $sr_addon_names) {
            $cart_item_data[] = array(
                'name' => __($sr_addon_names->name , "woocommerce"),
                'value' => strip_tags( '+ ' . wc_price( wc_get_price_to_display( $cart_item['data'], array('price' => $sr_addon_names->id ) ) ) )
                );
           }
          return $cart_item_data;
      }
      public function misha_add_order_item_meta( $item, $cart_item_key, $values, $order ) {
        $sr_addon_name = json_decode(stripslashes($values['sr_addon_name']));
          foreach ($sr_addon_name as $sr_addon_names) {
            $item->add_meta_data( $sr_addon_names->name, '+ $' .$sr_addon_names->id );
          }       
      }

      public function FIUPS_shortcode(){
        require_once FIUMS_PLUGIN_PATH . 'templates/custom-product-page.php';
      }
      public function add_custom_page_services(){
        require_once FIUMS_PLUGIN_PATH. 'inc/Page_creation.php';
      }
      public function FIUPS_extra_checkout_fields(){
        $checkout = WC()->checkout();
        echo '<div class="extra-fields">';
            foreach ( $checkout->checkout_fields['_FIUPS_comp_email2'] as $key => $field ) :
              woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
            endforeach;
        echo '</div>';      
      }
      public function FIUPS_save_extra_checkout_fields($order_id, $posted){
        if (!empty($_POST)) { //The values have been posted
            $elements = array();
            foreach ($_POST as $key => $val) { //For every posted values
                $frags = explode("1_", $key); //we separate the attribute name from the number
                $id = $frags[1]; //That is the id
                $attr = $frags[0]; //And that is the attribute name
                if (!empty($val)) {
                    //We then store the value of this attribute for this element.
                    $elements[$id][$attr] = htmlentities($val);
                }
            }
        }

        update_post_meta( $order_id, '_FIUPS_comp_email2', $elements);

      }
      public function FIUPS_display_order_data_in_admin($order){
        $order_id = $order->get_id();
        echo '<h4>Company Info</h4>';
        $array =  get_post_meta( $order_id, '_FIUPS_comp_email2', true );        
        $length = count($array);
          for ($i = 1; $i < $length; $i++) {
                echo '</div><div class="order_data_column">';
                echo '<div class="address">';
                echo '<p><strong>' . __( 'Company Name' ) . ':</strong>' . $array[$i]['FIUPS_comp_name'] . '</p>';
                echo '<p><strong>' . __( 'Company Registration' ) . ':</strong>' . $array[$i]['FIUPS_comp_reg'] . '</p>';
                echo '<p><strong>' . __( 'Company Email' ) . ':</strong>' . $array[$i]['FIUPS_comp_email'] . '</p>'; 
                echo '</div>';
          }
      }
      public function FIUPS_save_extra_details( $post_id, $post ){
          update_post_meta( $post_id, '_FIUPS_comp_email2', wc_clean( $_POST[ '_FIUPS_comp_email2' ] ) );
      }
      public function remove_custom_page_services(){
        global $wpdb;
        $the_page_title = get_option( "my_plugin_page_title" );
        $the_page_name = get_option( "my_plugin_page_name" );
        //  the id of our page...
        $the_page_id = get_option( 'my_plugin_page_id' );
        if( $the_page_id ) {
            wp_delete_post( $the_page_id ); // this will trash, not delete
        }
        delete_option("my_plugin_page_title");
        delete_option("my_plugin_page_name");
        delete_option("my_plugin_page_id");
      }

}
endif;
new FileItUsa_Multi_Step();

