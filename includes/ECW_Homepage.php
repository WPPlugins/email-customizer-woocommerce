
<?php

/*********************************************************************************
 * Email Customizer Woocommerce helps you to customize your mail content when status changed to product Delivered
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

$ecw_menu_obj = new Email_Customizer();
$ecw_menu_obj->ECW_Add_Menu();

if(isset($_POST['Form_Product_Delivered_Values_free']))
{
	if($_POST['ecw_email_order_subject'] != ''){
                update_option('ecw_email_order_subject',$_POST['ecw_email_order_subject']);
        }

        if($_POST['ecw_template_font_family'] != ''){
                update_option('ecw_template_font_family',$_POST['ecw_template_font_family']);
        }
        if($_POST['ecw_header_image_position'] != ''){
                update_option('ecw_header_image_position',$_POST['ecw_header_image_position']);
        }
        if($_POST['ecw_email_header_image'] != ''){
                update_option('ecw_email_header_image',$_POST['ecw_email_header_image']);
        }
        if($_POST['ecw_template_header_background_color'] != ''){
                update_option('ecw_template_header_background_color','#'.$_POST['ecw_template_header_background_color']);
        }
        if($_POST['ecw_template_body_background_color'] != ''){
                update_option('ecw_template_body_background_color','#'.$_POST['ecw_template_body_background_color']);
        }
        if($_POST['ecw_template_font_color'] != ''){
                update_option('ecw_template_font_color','#'.$_POST['ecw_template_font_color']);
        }

        if($_POST['ecw_product_delivered_main_text'] != ''){
		$ecw_main_text = stripslashes($_POST['ecw_product_delivered_main_text']);
                update_option('ecw_product_delivered_main_text', $ecw_main_text);
        }
        

	if($_POST['ecw_facebook_uri'] != ''){
                update_option('ecw_facebook_uri',$_POST['ecw_facebook_uri']);
        }
        if($_POST['ecw_twitter_uri'] != ''){
                update_option('ecw_twitter_uri',$_POST['ecw_twitter_uri']);
        }
        if($_POST['ecw_google_plus_uri'] != ''){
                update_option('ecw_google_plus_uri',$_POST['ecw_google_plus_uri']);
        }
        if($_POST['ecw_linkedin_uri'] != ''){
                update_option('ecw_linkedin_uri',$_POST['ecw_linkedin_uri']);
        }
        if($_POST['ecw_skype_uri'] != ''){
                update_option('ecw_skype_uri',$_POST['ecw_skype_uri']);
        }
        if($_POST['ecw_youtube_uri'] != ''){
                update_option('ecw_youtube_uri',$_POST['ecw_youtube_uri']);
        }

}

if(isset($_POST['ecw_mail_type']))
{
	echo '<input type="hidden" id="ECW_mail_type_yes" value="yes">';
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

        if( isset($_REQUEST['ecw_mail_type']) )
                $email_type = $_REQUEST['ecw_mail_type'];
        else
                $email_type = current($mails)->ID;
        //Get the most recent order.
        $order_collection = new WP_Query(array(
                        'post_type'                     => 'shop_order',
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
                                $_SESSION['template'] =  $template_content;
				update_option( 'ECW_Product_Delivered_template' , $template_content );
                                ?>

                                <form name='ecw_send_test_mail_form' method='post' action=''>
			<br>
			<div style="text-align:left;width:98%;margin-left:0.94%;" class='ecw_main_title'><i style='padding-right:1%;'class="fa fa-search fa-lg" aria-hidden="true"></i>Template Preview - Product Delivered</div>	
                                <div class="panel panel-primary" id='template_preview' style="width:98%;margin-left:0.94%;padding-bottom:0px;border: 1px solid #C6C2BF;border-radius:6px">
				<?php echo $template_content;  ?>
                                </div>
                                <?php
                        }
                }
        } ?>

	
	<div style="text-align:left;clear:left;margin-bottom:-3%;margin-left:1%;"><input type='submit' class="btn btn-primary"  name='ECW_Home' id='ECW_Home' value='Back' onclick='window.location.reload();'> </div>

	<div class="form-group" style="text-align:right;margin-right:1.5%">
                <input type='text' value='' placeholder='Enter email id' name='ecw_target_emailId' id='ecw_target_emailId' style='height:35px;width:200px;margin-right:0.5%;'>
                <input type='submit' class="btn btn-primary" name='ecw_send_test_mail' value='Send Test Mail' id='ecw_send_test_mail' />
        </div>

<?php
}

if(isset($_POST['ecw_send_test_mail']))
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
        $test_mail_to =  $_POST['ecw_target_emailId'];
        $testMail_subject = "Hi.. This is a test mail from Email Customizer Woocommerce";
        $mailer->send( $test_mail_to, $testMail_subject, $_SESSION['template']  );
}

?>

<form id='ecw_main_page' method='post' action='' style='width:98%;'>
<div id='ecw_pro_note' style='padding:1% 0%'>
	<table align='center'>
		<tr>
			<td>
				<img src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/tick_strict.png')?>"  />
			</td>
			
			<td>
				<span style='font-weight:bold;font-size:14px;'> Available in Free</span>
			</td>
			<td style='padding-left:10px;'>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                        </td>
			<td>
                                <span style='font-weight:bold;font-size:14px;'> Available in PRO Only</span>
                        </td>

		</tr>
	</table>
	</div>	
<div class="panel" style="width:100%;padding:20px;border: 1px solid #C6C2BF;border-radius: 6px;margin-top:0px;" id='ECW_main_panel'>
	
	<table class="table table-hover table-condensed" id='ecw_main_table' >
		<tr>
			<th style=""> Order Status </th>
			<th style="width:30%;"> Template Name </th>
			<th style='padding-left:3%;'> Action </th>
			<th style=''> Availability </th>
		</tr>		

		<tr>
                                <td>Product Delivered</td>
				</td>
					
				<td>Smack_Product_Delivered </td>	
		
				<td>
					<a href="" id="Edit_Product_Delivered" style='text-decoration:none;'><i class="fa fa-pencil " aria-hidden="true"></i> Edit</a>
					<span style='padding-left:10px;'> </span>
					<a href="" style='text-decoration:none;'><button class='view_template_link' id='View_Product_Delivered' name='ecw_mail_type' value='wc_product_delivered'><i class="fa fa-search" aria-hidden="true"></i><span> Preview</span></button></a>
				</td>
				<td>
					<img style='padding-left:21%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/tick_strict.png')?>"  />
				</td>
				
                </tr>

		<tr>
                                <td>New Order </td>
				<td>Smack_New_Order </td>
				<td>
					<div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil" aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search " aria-hidden="true"></i> Preview</label></div>
                                </td>
				<td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>


                        </tr>


			<tr>
                                <td>On Hold Order</td>
                                <td>Smack_On_Hold_Order </td>
                                <td>

                                <div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil " aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>

                                </td>
                                <td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>

                        </tr>

			<tr>
                                <td>Failed Order</td>
                                <td>Smack_Failed_Order </td>
                                <td>

                                <div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil " aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>

                                </td>
                                <td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>

                        </tr>

                        <tr>
                                <td>Cancelled Order</td>
				<td>Smack_Cancelled_Order </td>
				<td>
                                
				<div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil " aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>

				</td>
				<td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>

                        </tr>
                        <tr>
                                <td>Processing Order</td>
				<td>Smack_Processing_Order </td>
				<td>
                                <div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil " aria-hidden="true"></i> Edit</label></div>
                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>

				</td>
				<td>
                                        <img  style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>

                        </tr>
                        <tr>
                                <td>Completed Order</td>
				<td>Smack_Completed_Order </td>
				<td>
                                
				<div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil" aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>

				</td>
				<td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>
                        </tr>

                        <tr>
                                <td>Refunded Order</td>
				<td>Smack_Refunded_Order </td>
				<td>
				<div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil" aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>

				</td>

				<td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>
                        </tr>

                        <tr>
                                <td>Customer Invoice</td>
				<td>Smack_Customer_Invoice </td>
				<td>
                                
				<div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil" aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>

				</td>
				<td>
                                        <img  style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>


                        </tr>

			<tr>
                                <td>Customer Note</td>
				<td>Smack_Customer_Note </td>
				<td>
				<div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil " aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>
				</td>
				<td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>

                        </tr>
                        <tr>
                                <td>Reset Password</td>
				<td>Smack_Reset_Password </td>
				<td>
                                
				<div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil " aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search " aria-hidden="true"></i> Preview</label></div>
				</td>
				<td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>

                        </tr>
                        <tr>
                                <td>New Account</td>
				<td>Smack_New_Account </td>
				<td>
                                
				<div class='tooltipd ecw_pointer'><label style='color:#347ECA;'><i class="fa fa-pencil" aria-hidden="true"></i> Edit</label></div>

                                        <div class='tooltipd ecw_pointer' style='padding-left:10px;'><label style='color:#347ECA;'><i class="fa fa-search" aria-hidden="true"></i> Preview</label></div>

				</td>
	
				<td>
                                        <img style='padding-left:20%;' src="<?php echo esc_url(WP_CONTENT_URL . "/plugins/" . WP_CONST_EMAIL_CUST_SLUG . '/images/err.png')?>" title="PRO Feature" />
                                </td>


                        </tr>

	</table>
</div>
</form>


<!-- =============== END HOME PAGE ============= -->


<form id='product_delivered_form' name='product_delivered_form' method='post' action='' style='width:98%;'>
	<br>
	<div style="padding-bottom:10px;text-align:left;width:100%" class='ecw_main_title'><i style='padding-right:1%;' class="fa fa-edit fa-lg" aria-hidden="true"></i>Template Customization - Product Delivered</div>
<div id='product_delivered_contents'  class='panel panel-primary' style="border: 1px solid #C6C2BF;border-radius:0px 0px 6px 6px;">
	
<!-- BODY Content -->
	<div id='ecw_body_content' style='float:left;display:inline-block;width:70%;margin:1%' class='panel panel-info'>
	<div class="panel-group" id="accordion3">	
		<div class="panel panel-info">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion3" href="#collapseTwo5" style='cursor:pointer;'>
                                        <h4 class="panel-title">
                                                <a class="accordion-toggle">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        Template Text
                                                </a>
                                        </h4>
                                </div>
                                <div id="collapseTwo5" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                                <div class="" >
                                                        
                                                        	<div class="form-group">
								<table style='width:100%;'>
								<tr><td style='width:8%;'>
                                                                <label for='ecw_email_order_subject'>Subject:</label>
								</td>
								<td>
                                                                <input type='text' class='form-control' id='ecw_email_order_subject' name='ecw_email_order_subject' placeholder='email subject' value="<?php echo get_option('ecw_email_order_subject'); ?>" />
								</td>
								</table>
                                                        </div>

                                                        <div class="form-group">
                                                                <label for='ecw_product_delivered_main_text'>Content:</label>
								<?php
								$ecw_order_main_text = get_option('ecw_product_delivered_main_text');
								wp_editor( $ecw_order_main_text , 'ecw_product_delivered_main_text' );
								?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>		
	</div> <!-- END panel-group  -->


	
	</div> <!-- ecw_body_content -->

	<div id='ecw_template_variables' style='float:left;display:inline-block;width:26%;margin:1%;'>
	<div class="panel-group" id="accordion4">
                <div class="panel panel-info">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion4" href="#variable_replacement_note" style='cursor:pointer;'>
                                        <h4 class="panel-title">
                                                <a class="accordion-toggle">
                                                        <span class="glyphicon glyphicon-minus"></span>
                                                        WooCommerce Order Variables
                                                </a>
                                        </h4>
                                </div>
			<?php
			echo template_variables();
		?>
		</div>
	</div>

	<div id='ecw_appearance'>
	<div class="panel-group" id="accordion4">
                        <div class="panel panel-info">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion4" href="#collapseOne4" style='cursor:pointer;'>
                                        <h4 class="panel-title">
                                                <a class="accordion-toggle" >
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        Appearance     </a>
                                        </h4>
                                </div>
                                <div id="collapseOne4" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <div class="" >
							<div class="form-group">
                                                                <label for='ecw_template_body_background_color'>Background Color:</label>
                                                                <input class="color form-control" name='ecw_template_body_background_color' id='ecw_template_body_background_color' value="<?php echo get_option('ecw_template_body_background_color'); ?>">
                                                        </div>
                                                        
                                                        <div class="form-group">
			<?php
				$ecw_template_font_family_arr = array( 'Agency FB' , 'Antiqua' ,'Architect' ,'Arial' ,'BankFuturistic' ,'BankGothic' ,'Blackletter' ,'Blagovest' ,'Calibri' ,'Comic Sans' ,'Courier' ,'Cursive' ,'Decorative' ,'Fantasy' ,'Fraktur' ,'Frosty' ,'Garamond' ,'Georgia' ,'Helvetica' ,'Impact' ,'Minion' ,'Modern' ,'Monospace' ,'Open Sans' ,'Palatino' ,'Roman' ,'Sans-serif' ,'Serif' ,'Script' ,'Swiss' ,'Times' ,'Times New Roman' ,'Tw Cen MT' ,'Verdana' );
				$ecw_template_font_family_option = get_option( 'ecw_template_font_family' );
			?>

                                                                <label for='ecw_template_font_family'>Font Style:</label>
                                                                <select class='form-control' name='ecw_template_font_family' id='ecw_template_font_family'>
								<?php 
									foreach( $ecw_template_font_family_arr as $font_family_val )
									{
									?>
										<option value="<?php echo $font_family_val; ?>" <?php if( $font_family_val == $ecw_template_font_family_option ) {  echo "selected=selected";}?>> <?php echo $font_family_val; ?></option>
									<?php
										
									}
								?>

                                                                </select>
                                                        </div>
							<div class="form-group">
                                                                <label for='ecw_template_font_color'>Font Color:</label>
                                                                <input class="color form-control" name='ecw_template_font_color' id='ecw_template_font_color' value="<?php echo get_option('ecw_template_font_color'); ?>">
                                                        </div>


							<div class="form-group">
                                                                <label for='ecw_email_header_image'>Logo:</label>
                                                                <input type='text' class='form-control' id='ecw_email_header_image' name='ecw_email_header_image' placeholder='image url' value="<?php echo get_option('ecw_email_header_image'); ?>" />
                                                        </div>

                                                        <div class="form-group">
                                                                <label for='ecw_header_image_position'>Logo position:</label>
                                                                <select class='form-control' name='ecw_header_image_position' id='ecw_header_image_position'>
				<?php
					$ecw_header_image_position_arr = array(  'left' , 'center' ,'right' );	
					$ecw_header_image_position_option = get_option( 'ecw_header_image_position' );

					foreach( $ecw_header_image_position_arr as $image_position_val )
					{
						?>
                                                                        <option value="<?php echo $image_position_val; ?>" <?php if( $image_position_val == $ecw_header_image_position_option ) {  echo "selected=selected";}?>> <?php echo $image_position_val; ?></option>
                                                                        <?php
					}
				?>
                                                                </select>
                                                        </div>
                                                                                                                <div class="form-group">
                                                                <label for='ecw_template_header_background_color'>Logo Band Color:</label>
                                                                <input class="color form-control" name='ecw_template_header_background_color' id='ecw_template_header_background_color' value="<?php echo get_option('ecw_template_header_background_color');?>">
                                                        </div>
                                         </div> 
                                        </div>
                                </div>
                        </div> <!-- panel-info -->
	</div> <!-- panel-group -->
	</div>  <!-- ecw_appearance  -->

	<!-- SOCIAL LINKS -->
	<div class="panel-group" id="accordion4">
                <div class="panel panel-info">
                                <div class="panel-heading" data-toggle="collapse" data-parent="#accordion4" href="#collapseTwo7" style='cursor:pointer;'>
                                        <h4 class="panel-title">
                                                <a class="accordion-toggle" >
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                        Social Links
                                                </a>
                                        </h4>
                                </div>
				<div id="collapseTwo7" class="panel-collapse collapse">
                                        <div class="panel-body">
                                                <div class="" >	
							<div class="form-group">
                                                                        <label for='ecw_facebook_uri'>Facebook URI:</label>
                                                                        <input class="form-control" type='text' id='ecw_facebook_uri' name='ecw_facebook_uri' placeholder='' value="<?php echo get_option('ecw_facebook_uri'); ?>"/>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label for='ecw_twitter_uri'>Twitter URI:</label>
                                                                        <input class="form-control" type='text' id='ecw_twitter_uri' name='ecw_twitter_uri' placeholder='' value="<?php echo get_option('ecw_twitter_uri'); ?>"/>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label for='ecw_google_plus_uri'>Google+ URI:</label>
                                                                        <input class="form-control" type='text' id='ecw_google_plus_uri' name='ecw_google_plus_uri' placeholder='' value="<?php echo get_option('ecw_google_plus_uri'); ?>"/>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label for='ecw_linkedin_uri'>LinkedIn URI:</label>
                                                                        <input class="form-control" type='text' id='ecw_linkedin_uri' name='ecw_linkedin_uri' placeholder='' value="<?php echo get_option('ecw_linkedin_uri'); ?>"/>
                                                                </div>
                                                                
                                                                <div class="form-group">
                                                                        <label for='ecw_skype_uri'>Skype URI:</label>
                                                                        <input class="form-control" type='text' id='ecw_skype_uri' name='ecw_skype_uri' placeholder='' value="<?php echo get_option('ecw_skype_uri'); ?>"/>
                                                                </div>
                                                                <div class="form-group">
                                                                        <label for='ecw_youtube_uri'>Youtube URI:</label>
                                                                        <input class="form-control" type='text' id='ecw_youtube_uri' name='ecw_youtube_uri' placeholder='' value="<?php echo get_option('ecw_youtube_uri'); ?>"/>
                                                                </div>

						</div>
					</div>
				</div>
                </div>
        </div>



		
	</div> <!-- ecw_template_variables -->
	<br>
	

	<div style="width:48%;text-align:left;margin-left:1%;margin-bottom:2%;clear:left;"><input type='button' class="btn btn-primary" style='font-weight:bold'  name='ECW_Home_onEdit' id='ECW_Home_onEdit' value="<?php echo esc_attr__('<< Back',WP_CONST_EMAIL_CUST_SLUG);?>" onclick ="window.location.reload();" /> <input type='submit' class="btn" style='background:#FF4D55;color:#FFFFFF;font-weight:bold;'  name='discard' id='discard' value="<?php echo esc_attr__('Discard',WP_CONST_EMAIL_CUST_SLUG);?>" onclick='window.location.reload();' /></div>
                                <div style="width:48%;float:right;text-align:right;margin-top:-4.3%;margin-right:1%;"><button style='font-weight:bold;' class='btn btn-primary' id='View_Product_Delivered' name='ecw_mail_type' value='wc_product_delivered'><span> Preview</span></button> <input type='submit' class="btn btn-primary" data-toggle="modal" data-target="#smack_modal_free"  name='Form_Product_Delivered_Values_free' id='Form_Product_Delivered_Values_free' value='Save' style='font-weight:bold;'> </div>


</div> <!-- product_delivered_contents  -->
</form>  <!-- product_delivered_form -->

<!-- Modal -->
<div class="modal fade" id="smack_modal_free" role="dialog">
        <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                         <div class="modal-body">
                                <p style='color:green;text-align:center;'><b>Successfully Saved</b></p>
                        </div>
               </div>

        </div>
</div>

<?php

 function template_variables() {
	 	        $template_variables =  '<div id = "variable_replacement_note" class="panel-collapse collapse in">
                        <div class="panel-body" style="padding:20px;height:auto;">
			<div class="form-group">
                                <h5><strong> Drag and use the variables</strong></h5><br>
                                <p id = "{customer_name}" draggable="true" ondragstart="drag(event)" style="font-size:14px;cursor:pointer;"> <i style="padding-right:1%;" class="fa fa-hand-grab-o fa-lg" aria-hidden="true"></i> customer_name </p>
                                <p id = "{order_no}" draggable = "true" ondragstart="drag(event)"  style="font-size:14px;cursor:pointer;"><i style="padding-right:1%;" class="fa fa-hand-grab-o fa-lg" aria-hidden="true"></i> order_no</p>
                                <p id = "{order_date}" draggable = "true" ondragstart = "drag(event)"  style="font-size:14px;cursor:pointer;"><i style="padding-right:1%;" class="fa fa-hand-grab-o fa-lg" aria-hidden="true"></i> order_date</p>
                                <p id = "{blog_name}" draggable = "true" ondragstart = "drag(event)" style="font-size:14px;cursor:pointer;"><i style="padding-right:1%;" class="fa fa-hand-grab-o fa-lg" aria-hidden="true"></i> blog_name</p>
                                <p id = "{user_name}" draggable = "true" ondragstart = "drag(event)" style="font-size:14px;cursor:pointer;"><i style="padding-right:1%;" class="fa fa-hand-grab-o fa-lg" aria-hidden="true"></i> user_name</p>
			</div>
                        </div>
                </div>';
		return $template_variables;
}
