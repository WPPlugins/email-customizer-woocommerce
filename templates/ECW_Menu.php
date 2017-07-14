<?php

if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
}

?>
<nav class='navbar navbar-default' style='width:98%;' role='navigation'>
   <div>
<?php
	global $wpdb;	
        $admin_url = 'admin.php';
	$default = add_query_arg( array( 'page' => 'email_cust' ) , $admin_url );
        $product_based = add_query_arg( array( 'page' => 'product_based' ) , $admin_url );
?>
      <ul class='nav navbar-nav main_menu' style='width:99%;height:30px;'>

        <li class="<?php if( (sanitize_text_field($_REQUEST['page'])=='email_cust' ) ){ echo 'ecw_activate'; }else{ echo 'ecw_deactivate'; }?>">

        <a href='<?php echo esc_url( $default ); ?>'><span id='settingstab'>
<?php echo esc_html__("Order based Template" , "wordpress-email-customiser" ); ?> </span></a>
        </li>
<!-- for third party plugin settings -->
        <li style='width:23%;' class="<?php if( sanitize_text_field($_REQUEST['page']) =='product_based' ){ echo 'ecw_activate'; }else { echo 'ecw_deactivate'; }?>" >
                <a href='<?php echo esc_url( $product_based ); ?>'><span id='shortcodetab'>
 <?php echo esc_html__("Product / Category based Template" , "wordpress-email-customiser" ) ; ?></span><img style='padding-left:4px;position:absolute;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/ECW_pro.png')?>"  /></a>
        </li>
         
      </ul>
   </div>
</nav>

