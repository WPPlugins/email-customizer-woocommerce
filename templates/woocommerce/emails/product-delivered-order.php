<?php
/**
 * Product delivered email
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<?php do_action( 'woocommerce_email_header', $email_heading ); ?>
<?php                                                    

  $swcm_template_font_color = get_option('ecw_template_font_color');  

$user = get_user_by( 'id',1 );
$get_usermeta = get_user_meta($user->ID);
$customer_name = $order->billing_first_name.' '.$order->billing_last_name;
if(trim($customer_name) == '')
        $customer_name = $user->user_login;

$user_email = $user->user_email;
$order_no = $order->get_order_number();
$order_date = date_i18n( wc_date_format(), strtotime( $order->order_date ) ); 
$current_user = wp_get_current_user();
$user_login = $current_user->user_login;
if($customer_name != '')
{
$WC_order_page = admin_url()."post.php?post=";
$product_delivered_heading = get_option("ecw_product_delivered_heading");    
$swcm_product_delivered_heading = str_replace('{customer_name}',$customer_name,$product_delivered_heading);
$swcm_product_delivered_heading = str_replace('{order_no}', "<a target='_blank' href=".$WC_order_page.$order->get_order_number()."&action=edit>#".$order_no."</a>" ,$swcm_product_delivered_heading);
$swcm_product_delivered_heading = str_replace('{order_date}',$order_date,$swcm_product_delivered_heading);
$swcm_product_delivered_heading = str_replace('{blog_name}',get_bloginfo(),$swcm_product_delivered_heading);
$swcm_product_delivered_heading = str_replace('{user_name}',$user_login,$swcm_product_delivered_heading); 
}
else
{
$swcm_product_delivered_heading = get_option("ecw_product_delivered_heading");
}
if($order_no != '' && $order_date != '')
{
$WC_order_page = admin_url()."post.php?post=";
$product_delivered_main_text = get_option( "ecw_product_delivered_main_text" );
$swcm_product_delivered_main_text =str_replace('{order_no}', "<a target='_blank' href=".$WC_order_page.$order_no."&action=edit>#".$order_no."</a>" ,$product_delivered_main_text); 
$swcm_product_delivered_main_text =str_replace('{order_date}',$order_date,$swcm_product_delivered_main_text);
$swcm_product_delivered_main_text = str_replace('{blog_name}',get_bloginfo(),$swcm_product_delivered_main_text);
$swcm_product_delivered_main_text = str_replace('{user_name}',$user_login,$swcm_product_delivered_main_text);
$swcm_product_delivered_main_text = str_replace('{customer_name}',$customer_name,$swcm_product_delivered_main_text); 
}
else
{
$swcm_product_delivered_main_text = get_option( "ecw_product_delivered_main_text" );
}



?>
                <!-- [ middle starts here] -->
<div style="padding-left:55px;padding-right:55px;padding-top:20px;padding-bottom:20px;line-height:1.3em;color:<?php echo $swcm_template_font_color; ?>;">
<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td valign="top" >
			
			<div>
			<p style='text-align:left;font-size:24px;'><strong><?php  echo($swcm_product_delivered_heading); ?></strong></p> 
			</div>
			<div>
				<?php echo($swcm_product_delivered_main_text);?>
			</div>


<br><br>

<table cellpadding="0" cellspacing="0" border="0" width="100%" >
	<tr>
		<td>
			
			<?php echo get_option('ecw_order_details_heading'); ?>
			
			<table cellspacing="0" cellpadding="0" border="0" width="100%">
				<tr>
					<td style="text-align:left; padding: 12px 0 6px;">
						<span style ="font-weight: bold;">
							Order Number:
						</span> 
						<?php echo $order->get_order_number(); ?>
					</td>
					<td  style="text-align:right; padding: 12px 0 6px;">
						<span style ="font-weight: bold;">
						        Order Date:
						</span> 
						<?php printf( '<time datetime="%s">%s</time>', date_i18n( 'c', strtotime( $order->order_date ) ), date_i18n( wc_date_format(), strtotime( $order->order_date ) ) ); ?>
					</td>
				</tr>
			</table>
						
			<table cellspacing="10" cellpadding="10" border="1" frame=hsides rules=rows style="width:100%;border-top:2px solid #005000;"  >
				<thead>
					<tr style="border-bottom:2px solid #005000;">
						<th><?php echo( 'Product' ); ?></th>
						<th><?php echo( 'Quantity' ); ?></th>
						<th><?php echo( 'Price' ); ?></th>
					</tr>
				</thead>
				<tbody style="border-bottom:2px dotted #005000;">
					<?php echo $order->email_order_items_table( false, true ); ?>
				</tbody>
				<tfoot>
					<?php
					if ( $totals = $order->get_order_item_totals() ) {
						$i = 0;
						foreach ( $totals as $total ) {
							$i++;
							?>
							<tr style="border-bottom:2px dotted #005000;">
								<th>
									<?php echo $total['label']; ?>
								</th>
								<td style='text-align:"right"' >
									<?php echo $total['value']; ?>
								</td>
								<td>
								</td>
							</tr>
							<?php
						}
					}
					?>
				</tfoot>
			</table>
<br><br>
			
			<?php do_action( 'woocommerce_email_after_order_table', $order, true, false ); ?>
			
		</td>
	</tr>
</table>
<?php $swcm_upload_dir = wp_upload_dir();
$destination_folder =  $swcm_upload_dir['baseurl'].'/email-customizer-woocommerce';

$facebook = $destination_folder.'/facebook.png';
$twitter =  $destination_folder.'/twitter.png';
$googleplus =  $destination_folder.'/googleplus.png';
$linkedin = $destination_folder.'/linkedin.png' ;
$instagram =  $destination_folder.'/Instagram.png';
$skype =  $destination_folder.'/skype.png';
$youtube = $destination_folder.'/youtube.png' ;


$ecw_facebook_uri = get_option('ecw_facebook_uri');
$ecw_twitter_uri = get_option('ecw_twitter_uri');
$ecw_google_plus_uri =  get_option('ecw_google_plus_uri');
$ecw_linkedin_uri = get_option('ecw_linkedin_uri');
$ecw_instagram_uri = get_option('ecw_instagram_uri');
$ecw_skype_uri =  get_option('ecw_skype_uri');
$ecw_youtube_uri = get_option('ecw_youtube_uri');
 ?>

<div style="border: 1px solid #E0E0E0;font-size: 12px;height: auto;line-height: 16px;margin: 0;background: #f9f9f9;width: 100%;padding: 10px;min-height: 40px;">
                              <div style='width:65%;float:left;'>  You can check the status of your order by <a target='_blank' href="<?php echo site_url();?>/index.php/my-account">login your account.</a> </div>
							    

		<div class="social" style="float:right;width:33%;margin:-7px;">
    <ul>
	<?php if($ecw_facebook_uri != '' ) { ?>
        <li><a target='_blank' href="<?php echo get_option('ecw_facebook_uri');  ?>"><img width="20" height="20" src="<?php echo $facebook?>" class="facebook" /></a></li>
	<?php } 
	if( $ecw_twitter_uri != '' ) {
	?>
       <li><a target='_blank' href="<?php echo get_option('ecw_twitter_uri');  ?>"><img width="20" height="20" src="<?php echo $twitter; ?>" class="twitter" /></a></li>
	<?php }
	if( $ecw_google_plus_uri != '' ) {
	?>
        <li><a target='_blank' href="<?php echo get_option('ecw_google_plus_uri');  ?>"><img width="20" height="20" src="<?php echo  $googleplus; ?>" class="google-plus" /></a></li>
	<?php } 
	if( $ecw_linkedin_uri != '' ) {
	?>
        <li><a target='_blank' href="<?php echo get_option('ecw_linkedin_uri');  ?>"><img width="20" height="20" src="<?php echo $linkedin; ?>" class="linkedin" /></a></li>
	<?php }
	if( $ecw_skype_uri != '' ) {	
	?>
	
        <li><a target='_blank' href="<?php echo get_option('ecw_skype_uri');  ?>"><img width="20" height="20" src="<?php echo $skype; ?>" class="skype" /></a></li>
	<?php }
	if( $ecw_youtube_uri != '' ) {
	?>	
       <li><a target='_blank' href="<?php echo get_option('ecw_youtube_uri');  ?>"><img width="20" height="20" src="<?php echo  $youtube; ?>" class="youtube" /></a></li>
	<?php }
	?>
    </ul>
</div>
 </div>
			
       			<div>
				<?php do_action( 'woocommerce_email_before_order_table', $order, true, false ); ?>
			</div>  
 
			
		</td>
	</tr>
</table>
</div>
<style>
.social {
    margin: 0;
    padding: 0;
}

.social ul {
    margin: 0;
    padding: 5px;
}

.social ul li {
    margin: 5px;
    list-style: none outside none;
    display: inline-block;
}

</style>

<?php do_action( 'woocommerce_email_footer' ); ?>
