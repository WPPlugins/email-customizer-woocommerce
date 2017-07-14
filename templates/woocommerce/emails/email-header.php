<?php
/**
 * Email Header
 *
 * @author  WooThemes
 * @package WooCommerce/Templates/Emails
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
   //echo "<pre>"; print_r($_REQUEST['wc_order_action']); die;
?>
<?php  $swcm_email_heading = get_option('ecw_email_heading'); ?> 
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 

       <title><?php //echo get_bloginfo( 'name', 'display' ); ?></title>
	</head>  
   <body <?php echo is_rtl() ? 'rightmargin' : 'leftmargin'; ?>="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">   
  <div id="whole_container">   	
        	<table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%">

            	<tr>
		 <?php $swcm_header_img_position = get_option('ecw_header_image_position'); ?>
			
                	<td  valign="top" align="center" style="border:solid 2px #F4F2FF;padding-top:40px;padding-bottom:20px;" >
<?php $swcm_template_header_background_color = get_option('ecw_template_header_background_color'); ?>
					<div style="display:table-cell; text-align:center; vertical-align:middle;width:800px;background-color:<?php echo $swcm_template_header_background_color; ?>;">	
	                		<?php
					     
	                			if ( $img = get_option( 'ecw_email_header_image' ) ) {
	                				echo '<p align="'.$swcm_header_img_position.'" style="margin-top:0;margin-bottom:0;width:800px;padding:20px 27px;"><img src="' . esc_url( $img ) . '" alt="' . get_bloginfo( 'name', 'display' ) . '" /></p>';
	                			}
	                		?>
							
	</div>
                   	<table border="0" cellpadding="0" cellspacing="0" width="800" id="custom_template_container" style="background-color:<?php echo get_option('ecw_template_body_background_color');?>;">
                        <!--	<tr>
                            	<td align="center" valign="top" style='background-color:blue;width:800px;'>   -->
                                    <!-- Header -->
                                <!--	<table border="0" cellpadding="0" cellspacing="0" width="600">
                                        <tr>
                                            <td valign="top">  --> 
 
                         <!--              	
                                            </td>
                                        </tr>
                                    </table>      -->
                                    <!-- End Header -->
                      <!--          </td>
                            </tr>  -->
                        	<tr> 
                            	<td align="center" valign="top"> 
                                    <!-- Body -->
<?php  $swcm_template_font_family = get_option('ecw_template_font_family');  ?> 
                                	<table border="0" cellpadding="0" cellspacing="0" width="800" id="SWCM_template_body" style="border:solid 2px #F4F2FF;font-family:'<?php echo $swcm_template_font_family; ?>'">
                                    	<tr>
                                            <td valign="top" id="SWCM_body_content"> 
                                                <!-- Content -->
                                                <table border="0" cellpadding="20" cellspacing="0" width="100%">
                                                    <tr>
                                                        <td valign="top">
                                                            <div id="SWCM_body_content_inner">  
