<?php
/**
 * Plugin Name: Email Customizer Woocommerce
 * Plugin URI: www.smackcoders.com
 * Description: Send customized & more powerful emails to your prospects & customers based on Woocommerce order status.
 * Author: Smackcoders
 * Author URI: www.smackcoders.com
 * Company: Smackcoders Technologies PVT Ltd
 * Version: 1.2
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 *
 */

/*********************************************************************************
 * Email Customizer Woocommerce helps you to customize your mail content and send when status changed to product Delivered
 * plugin developed by Smackcoder. Copyright (C) 2016 Smackcoders.
 *
 * Email Customizer Woocommerce is a free software; you can redistribute it and/or
 * modify it under the terms of the GNU Affero General Public License version 3
 * as published by the Free Software Foundation with the addition of the
 * following permission added to Section 15 as permitted in Section 7(a): FOR
 * ANY PART OF THE COVERED WORK IN WHICH THE COPYRIGHT IS OWNED BY Email Customizer Woocommerce,
   Email Customizer Woocommerce DISCLAIMS THE WARRANTY OF NON
 * INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * Email Customizer Woocommerce is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 * or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public
 * License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program; if not, see http://www.gnu.org/licenses or write
 * to the Free Software Foundation, Inc., 51 Franklin Street, Fifth Floor,
 * Boston, MA 02110-1301 USA.
 *
 * You can contact Smackcoders at email address info@smackcoders.com.
 *
 * The interactive user interfaces in original and modified versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License
 * version 3, these Appropriate Legal Notices must retain the display of the
 * Email Customizer Woocommerce copyright notice. If the display of the logo is
 * not reasonably feasible for technical reasons, the Appropriate Legal
 * Notices must display the words
 * "Copyright Smackcoders. 2016. All rights reserved".
 ********************************************************************************/

 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$upload_dir = wp_upload_dir();
define( 'Email_Customizer_Woocommerce', plugin_dir_path( __FILE__ ) );
define('WP_CONST_EMAIL_CUST_NAME', 'Email Customizer Woocommerce');
define('WP_CONST_EMAIL_CUST_SLUG', 'email-customizer-woocommerce');
define('WP_CONST_EMAIL_CUST_FREE_SLUG' , 'wordpress_email_customiser');
define('WP_CONST_EMAIL_CUST_VERSION', '1.2');
define('WP_CONST_EMAIL_CUST_DIR', WP_PLUGIN_URL . '/' . WP_CONST_EMAIL_CUST_SLUG . '/');
define('WP_CONST_EMAIL_CUST_DIRECTORY', plugin_dir_path(__FILE__));
define('WP_CONST_EMAIL_CUST_PLUGIN_BASE', WP_CONST_EMAIL_CUST_DIRECTORY);
define('WP_CONST_EMAIL_CUST_PLUG_URL_PRO',site_url().'/wp-admin/admin.php?page=email_cust');
define('WP_CONST_EMAIL_CUST_PLUG_PROD_URL_FREE',site_url().'/wp-admin/admin.php?page=product_based');


register_activation_hook( __FILE__, array( 'Email_Customizer', 'ECW_activation' ) );
register_deactivation_hook( __FILE__, array( 'Email_Customizer', 'ECW_deactivation' ) );

function ECW_Custom_mail_scripts()
{
	if(isset($_REQUEST['page']) && (sanitize_text_field($_REQUEST['page']) == 'email_cust' || sanitize_text_field($_REQUEST['page']) == 'product_based' )) {
		wp_enqueue_script('ECW_tinymce_email', plugins_url('js/email_content.js', __FILE__));
		wp_enqueue_script( 'ECW_bootstrap.min.js' , plugins_url( 'js/bootstrap.min.js' , __FILE__) );
		wp_enqueue_script('ECW_jscolor.js', plugins_url('js/jscolor.js', __FILE__));

		//CSS
		wp_enqueue_style( 'ECW_bootstrap.css' , plugins_url( 'css/bootstrap.css' , __FILE__) );
		wp_enqueue_style( 'ECW_mainstyle.css' , plugins_url( 'css/ECW_mainstyle.css' , __FILE__) );
		wp_enqueue_style( 'ECW_font_awesome.css' , plugins_url( 'css/font-awesome.min.css' , __FILE__) );
	}
}

class Email_Customizer
{
	public function ECW_Add_Menu() {
		require_once('templates/ECW_Menu.php');
	}	

	public function ECW_activation() {
		update_option( 'ECW_Version' , WP_CONST_EMAIL_CUST_VERSION );
		$deprecated = null;
		$autoload = 'no';
		add_option('ecw_template_font_family','Arial',$deprecated,$autoload);
		add_option('ecw_header_image_position','center',$deprecated,$autoload);
		add_option('ecw_email_header_image','http://volumeone.org/themes/buylocal/images/your_logo_here.png',$deprecated,$autoload);
		add_option('ecw_template_header_background_color','#424FFF',$deprecated,$autoload);
		add_option('ecw_template_body_background_color','#FFFFFF',$deprecated,$autoload);
		add_option('ecw_order_details_heading',"<strong>Order Details</strong>",$deprecated,$autoload);
		add_option('ecw_customer_details_heading',"<strong>Customer details</strong>",$deprecated,$autoload);
		add_option('ecw_customer_new_account_heading',"New Account created!!",$deprecated,$autoload);
		add_option('ecw_customer_new_account_main_text',"<p>Thanks for creating an account on {blog_name}. Your username is <strong>{user_name}</strong></p>",$deprecated,$autoload);
		add_option('ecw_customer_note_heading',"A note has been added to your order",$deprecated,$autoload);
		add_option('ecw_customer_note_main_text',"<p>A note has just been added to your order.</p><p>For your reference, your order details are shown below.</p>",$deprecated,$autoload);
		add_option('ecw_product_delivered_heading',"Dear {customer_name}",$deprecated,$autoload);
		add_option('ecw_product_delivered_main_text',"<p>Your order {order_no} on {order_date} has been delivered.</p>",$deprecated,$autoload);
		add_option('ecw_template_font_color','#000000',$deprecated,$autoload);	
		add_option('ecw_facebook_uri','',$deprecated,$autoload);
		add_option('ecw_twitter_uri','',$deprecated,$autoload);
		add_option('ecw_google_plus_uri','',$deprecated,$autoload);
		add_option('ecw_linkedin_uri','',$deprecated,$autoload);
		add_option('ecw_skype_uri','',$deprecated,$autoload);
		add_option('ecw_youtube_uri','',$deprecated,$autoload);

        }
        public static function add_email_customizer_menu()    {
		global $submenu;
		add_menu_page( WP_CONST_EMAIL_CUST_SLUG , 'Email Customizer','manage_options', WP_CONST_EMAIL_CUST_FREE_SLUG , array('Email_Customizer','ecw_homepage'));
		add_submenu_page( WP_CONST_EMAIL_CUST_FREE_SLUG , 'Order based Template' , 'Order based Template', 'manage_options', 'email_cust', array('Email_Customizer','ecw_homepage') );
		add_submenu_page( WP_CONST_EMAIL_CUST_FREE_SLUG , 'Product/Category based Template' , 'Product / Category based Template', 'manage_options', 'product_based', array('Email_Customizer','ecw_product_based_template') );
        unset( $submenu[WP_CONST_EMAIL_CUST_FREE_SLUG][0] );

        }

	public static function ecw_product_based_template()
	{
		require_once('includes/ECW_Product_Based.php');
	}

	public function ECW_deactivation()
	{
		delete_option('ecw_template_font_family');
		delete_option('ecw_header_image_position');
		delete_option('ecw_email_header_image');
		delete_option('ecw_template_header_background_color');
		delete_option('ecw_template_body_background_color');
		delete_option('ecw_order_details_heading');
		delete_option('ecw_customer_details_heading');
		delete_option('ecw_customer_new_account_heading');
		delete_option('ecw_customer_new_account_main_text');
		delete_option('ecw_customer_note_heading');
		delete_option('ecw_customer_note_main_text');
		delete_option('ecw_product_delivered_heading');
		delete_option('ecw_product_delivered_main_text');
		delete_option('ecw_template_font_color');
		delete_option('ecw_facebook_uri');
		delete_option('ecw_twitter_uri');
		delete_option('ecw_google_plus_uri');
		delete_option('ecw_linkedin_uri');
		delete_option('ecw_skype_uri');
		delete_option('ecw_youtube_uri');
	}

	public static function ecw_homepage()
	{
		require_once( 'includes/ECW_Homepage.php' );
	}
	
}

function ECW_my_session()
{
    if( !session_id() )
    {
        session_start();
    }
}

//code for copying images folder to uploads folder
$swcm_upload_dir = wp_upload_dir();
$destination_folder =  $swcm_upload_dir['basedir'].'/email-customizer-woocommerce';
if (!file_exists($destination_folder)) {
   mkdir($destination_folder,0755, true);
}
$plugin_path = plugin_dir_path( __FILE__ );

$src = $plugin_path.'images';
   $dst = $destination_folder;
   $files = glob("$src/*.*");
   foreach($files as $file){
       $file_to_go = str_replace($src,$dst,$file);
       copy($file, $file_to_go);
  }


add_action( 'init' , 'ECW_my_session' );
add_action('admin_menu', array('Email_Customizer', 'add_email_customizer_menu'));


#smack-woocommerce-custom-mail

/**
 *  Add a custom email to the list of emails WooCommerce should load
 *
 * @since 0.1
 * @param array $email_classes available email classes
 * @return array filtered available email classes
 */
function add_product_delivered_woocommerce_email( $email_classes ) {
    // include our custom email class
	if (!class_exists('WC_Product_Delivered_Email'))
    require( 'includes/class-wc-product-delivered-email.php' );
 
    // add the email class to the list of email classes that WooCommerce loads
    $email_classes['WC_Product_Delivered_Email'] = new WC_Product_Delivered_Email();

	update_option( 'new_class' , $email_classes ); 
    return $email_classes;
 
}
add_filter( 'woocommerce_email_classes', 'add_product_delivered_woocommerce_email' );

function register_product_delivered_order_status() {
    register_post_status( 'wc-product-delivered', array(
        'label'                     => _x( 'Product Delivered', 'Order status', 'woocommerce' ),
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Product delivered <span class="count">(%s)</span>', 'Product delivered <span class="count">(%s)</span>' )
    ) );
}
add_action( 'admin_init', 'register_product_delivered_order_status' );  
add_action( 'admin_init' , 'ECW_Custom_mail_scripts' );

/* Add Order action to Order action meta box */
    
function add_Product_delivered_status_to_meta_box_actions($actions)
{
   $actions['wc-product-delivered'] = _x( 'Product Delivered', 'Order status', 'woocommerce' );
   return $actions; 
}

add_action( 'woocommerce_order_actions', 'add_Product_delivered_status_to_meta_box_actions' );


// if order action is product delivered do the following
add_action('woocommerce_order_action_product_delivered', 'wdm_order_status_product_delivered_callback');
function wdm_order_status_product_delivered_callback( $order_id )
{
        //Here order id is sent as parameter
        //Add code for processing here
        global $woocommerce;
        $order = new WC_Order( $order_id );                  
        if($order->post_status === 'wc-product-delivered' ) {   
                // Create a mailer
                $mailer = $woocommerce->mailer();
                $orderID = $order->get_order_number();
                $get_postmeta = get_post_meta($orderID);
                $customer_name = $get_postmeta['_billing_first_name'][0] . ' ' . $get_postmeta['_billing_last_name'][0];
                
		$template_content = ECW_get_dynamic_mail_content();
                // Cliente email, email subject and message.
                $mailer->send( $order->billing_email, sprintf( __( 'Order %s delivered' ), $order->get_order_number() ), $template_content );
        }
}



// Add to list of WC Order statuses
function add_product_delivered_to_order_statuses( $order_statuses ) {

    $new_order_statuses = array();

    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {

        $new_order_statuses[ $key ] = $status;

        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-product-delivered'] = 'Product Delivered ';
        }
    }

    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_product_delivered_to_order_statuses' );


	
function myplugin_plugin_path() {
 
  // gets the absolute path to this plugin directory
 
  return untrailingslashit( plugin_dir_path( __FILE__ ) );
 
}
 
 
 
add_filter( 'woocommerce_locate_template', 'myplugin_woocommerce_locate_template', 10, 3 );
 
 
 
function myplugin_woocommerce_locate_template( $template, $template_name, $template_path ) {   //  echo($template_name); die("aa"); 
 
  global $woocommerce;
  $_template = wc_clean($template);
  if ( ! $template_path ) $template_path = $woocommerce->template_url;
  $plugin_path  = myplugin_plugin_path() . '/templates/woocommerce/';
 
  // Look within passed path within the theme - this is priority
  $template = locate_template(
    array(
      $template_path . $template_name,
      $template_name
    )
  );
  // Modification: Get the template from this plugin, if it exists
  if ( ! $template && file_exists( $plugin_path . $template_name ) )
    $template = $plugin_path . $template_name;                 	      
  // Use default template
  if ( ! $template )
    $template = $_template;                                   
  // Return what we found
  return $template;
}

function ECW_get_dynamic_mail_content()
{
	global $woocommerce;
        if( class_exists('WC') ) {
                $mailer = WC()->mailer();
                $mails = $mailer->get_emails();
                // Ensure gateways are loaded in case they need to insert data into the emails
                WC()->payment_gateways();
                WC()->shipping();
        }
        else{
                $mailer = $woocommerce->mailer();
                $mails = $mailer->get_emails();
                // Ensure gateways are loaded in case they need to insert data into the emails
                $woocommerce->payment_gateways();
                $woocommerce->shipping();
        }
        /* Get Email to Show */
                $email_type = 'wc_product_delivered';
        //Get the most recent order.
        $order_collection = new WP_Query(array(
                        'post_type'             => 'shop_order',
			'post_status'           => array_keys( wc_get_order_statuses() ),
                        'posts_per_page'        => 1,

        ));

        $order_collection = $order_collection->posts;
        $latest_order = current($order_collection)->ID;
        $order_to_show = $latest_order;


        if ( !empty( $mails ) ) {

                foreach ( $mails as $mail ) {
                        if ( $mail->id == $email_type ) {

                                $order = new WC_Order( $order_to_show );
                                $new_mail = new $mail();
                                $new_mail->object = $order;
                                $template_content = $new_mail->get_content();
				}
			}
	}
		return $template_content;
}

function ECW_order_status_changed( $order_id )
{
	global $woocommerce;
   $order = new WC_Order( $order_id );
	if($order->status === 'product-delivered' ) {
                // Create a mailer
                $mailer = $woocommerce->mailer();
                $orderID = $order->get_order_number();
                $get_postmeta = get_post_meta($orderID);
                $customer_name = $get_postmeta['_billing_first_name'][0] . ' ' . $get_postmeta['_billing_last_name'][0];
                $Product_delivered_Template = get_option('ECW_Product_Delivered_template');
		$mail_template = ECW_get_dynamic_mail_content();
		$email_subject = get_option('ecw_email_order_subject');
	
		$customer_name = $order->billing_first_name.' '.$order->billing_last_name;
		$order_no = $order->get_order_number();
		$order_date = date_i18n( wc_date_format(), strtotime( $order->order_date ) );
		$current_user = wp_get_current_user();
		$user_login = $current_user->user_login;
	
		if(empty($email_subject))
		{
			$email_subject = 'Order Delivered Successfully!!';
		}
		else
		{
			$WC_order_page = admin_url()."post.php?post=";
			$email_subject = str_replace('{customer_name}',$customer_name,$email_subject);
			$email_subject = str_replace('{order_no}', "<a target='_blank' href=".$WC_order_page.$order->get_order_number()."&action=edit>#".$order_no."</a>" ,$email_subject);
			$email_subject = str_replace('{order_date}',$order_date,$email_subject);
			$email_subject = str_replace('{blog_name}',get_bloginfo(),$email_subject);
			$email_subject = str_replace('{user_name}',$user_login,$email_subject);

		}
                $mailer->send( $order->billing_email, $email_subject, $mail_template);
        }

}

add_action( 'woocommerce_order_status_changed' , 'ECW_order_status_changed' , 10 ,1);

//NEW

add_filter( 'woocommerce_email_actions', 'ECW_filter_actions' );
function ECW_filter_actions( $actions ){
    $actions[] = "woocommerce_order_status_product_delivered";
    return $actions;
}
