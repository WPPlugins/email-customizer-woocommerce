<?php
/**
 * Email Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ( $order->get_billing_address() || $order->get_shipping_address() ) : ?>
		
	<table cellpadding="0" cellspacing="0" border="0" width="100%">
		<tr>
			<td width="50%" valign="top">
				
				<p><strong><?php echo("Billing address"); ?>:</strong></p>
				<p><?php echo $order->get_formatted_billing_address(); ?></p>
				
			</td>
			<td width="50%" valign="top">
				
				<p><strong><?php echo("Shipping address"); ?>:</strong></p>
				<p><?php echo $order->get_formatted_shipping_address(); ?></p>
				
			</td>
		</tr>
	</table>

<?php endif; ?>
