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

// PB-one
if(isset($_REQUEST['page']) && $_REQUEST['page'] == 'product_based' && !isset($_REQUEST['action']) )
{
?>
<form id='swcm_ui_form_product_based' method='post' action='' style="width:98%;">
        <!--<div class="container" style="width:1300px;"> -->

	<div class="ECW_pro_upgrade_notice" style="text-align:center;width: 96.5%;">
        <a  style='text-decoration:none;' href ="http://www.smackcoders.com/email-customizer-woocommerce-pro.html"  class="free-notice" target="_blank"><h4> Now upgrade to Pro version for Product / Category Based Template</h4>
        </a>
	</div>
	
	<br>
<div class="panel" style="width:100%;padding:20px;border: 1px solid #C6C2BF;border-radius:6px;margin-top:0px;" id="SWCM_main_panel">
        <input type='button' disabled class="btn btn-primary" style='font-weight:bold;color:white'  name='ECWfree_create_new_template' id='ECWfree_create_new_template' value="<?php echo esc_attr__('Add New Template',WP_CONST_EMAIL_CUST_SLUG);?>"  />
        <br><br>
        <table class="table table-hover table-condensed" id="ecw_main_table">

                        <tr>
                                <th> <?php echo esc_html__('Template Name' , WP_CONST_EMAIL_CUST_SLUG); ?> </th>
                                <th> <?php echo esc_html__('Type' , WP_CONST_EMAIL_CUST_SLUG); ?> </th>
                                <th style='padding-left:3%;'> <?php echo esc_html__('Actions' , WP_CONST_EMAIL_CUST_SLUG ); ?> </th>
                        </tr>

                                                <tr>
                                                <td> Email Customizer For WooCommerce Premium  </td>
                                                <td> product </td>
                                                <td>
                                                        <a class='ecw_pointer'  id="Edit_template" style='text-decoration:none;'><i class="fa fa-pencil " aria-hidden="true"></i> <?php echo esc_html__('Edit' , WP_CONST_EMAIL_CUST_SLUG);  ?></a>
                                                        <span style='padding-left:10px;'> </span>
                                                        <a href="<?php echo WP_CONST_EMAIL_CUST_PLUG_PROD_URL_FREE .'&status=1&action=Preview&swcm_mail_type=customer-product-_based&ECW_from=Home' ;?>" id="New_Order" style='text-decoration:none;'><i class="fa fa-search " aria-hidden="true"></i> <?php echo esc_html__('Preview' , WP_CONST_EMAIL_CUST_SLUG);  ?></a>
                                                 </td>
                                        </tr>
				
					<tr>
                                                <td> WordPress Products </td>
                                                <td> Category </td>
                                                <td>
                                                        <a class='ecw_pointer' id="Edit_template" style='text-decoration:none;'><i class="fa fa-pencil " aria-hidden="true"></i> <?php echo esc_html__('Edit' , WP_CONST_EMAIL_CUST_SLUG);  ?></a>
                                                        <span style='padding-left:10px;'> </span>
                                                        <a href="<?php echo WP_CONST_EMAIL_CUST_PLUG_PROD_URL_FREE .'&status=2&action=Preview&swcm_mail_type=customer-product_based&ECW_from=Home' ;?>" id="New_Order" style='text-decoration:none;'><i class="fa fa-search " aria-hidden="true"></i> <?php echo esc_html__('Preview' , WP_CONST_EMAIL_CUST_SLUG);  ?></a>
                                                 </td>
                                        </tr>
	
        </table>

</div>

</form>
<?php
} // <!-- PB-one-END -->



// PB-two
if(isset($_REQUEST['page']) && isset($_REQUEST['action']) && $_REQUEST['action'] == 'customise_product' && $_REQUEST['doaction'] == 'create_new_template')
{

	die('Anto');
}


if( (isset( $_REQUEST['page']) && $_REQUEST['page'] == 'product_based' ) && isset( $_REQUEST['status']) && isset( $_REQUEST['action']) && $_REQUEST['action'] == 'Preview' )
{
	if($_REQUEST['status'] == 1 )
	{ ?>
		<div style='background-color:#FFF;border-color:#666;padding:20px 0px;width:98%;'>

		<div class="ECW_pro_upgrade_notice" style="text-align:center;width: 96.5%;">
        	<a  style='text-decoration:none;' href ="http://www.smackcoders.com/email-customizer-woocommerce-pro.html"  class="free-notice" target="_blank"><h4> Now upgrade to Pro version for Product / Category Based Template</h4>
        	</a>
        	</div>

		<br> <br>
		<img style='width:98%;margin-left:1%;' src="<?php echo WP_CONST_EMAIL_CUST_DIR;?>/images/ecw_product.png">
		</div>
	
	<?php }
	else if($_REQUEST['status'] == 2 )
	{ ?>

		<div style='background-color:#FFF;border-color:#666;padding:20px 0px;width:98%;'>
		<div class="ECW_pro_upgrade_notice" style="text-align:center;width: 96.5%;">
        	<a  style='text-decoration:none;' href ="http://www.smackcoders.com/email-customizer-woocommerce-pro.html"  class="free-notice" target="_blank"><h4> Now upgrade to Pro version for Product / Category Based Template</h4>
        	</a>
        	</div>
		<br><br>
		<img style='width:98%;margin-left:1%;' src="<?php echo WP_CONST_EMAIL_CUST_DIR;?>/images/ecw_category.png">
		
		</div>
	<?php			
	}
}

