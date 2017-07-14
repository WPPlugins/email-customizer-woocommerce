<?php
/**
 * Email Footer
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
															</div>
														</td>
                                                    </tr>
                                                </table>
                                                <!-- End Content -->
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- End Body -->
                                </td>
                            </tr>
			<?php
						$footer_text	= get_option("ecw_email_footer_text");
						$footer_image	= get_option('ecw_email_footer_image');	
	 				         $swcm_template_font_color = get_option('ecw_template_font_color');					
						if ( $footer_image &&  $footer_text && (get_option('ecw_email_footer_image_position') != get_option('ecw_email_footer_text_position'))  ) {
							?>
                        	<tr valign="top" >
<td style="padding:10px;color:<?php echo $swcm_template_font_color; ?>;">
<span style="float:<?php echo get_option('ecw_email_footer_image_position');  ?>"> <img src="<?php echo get_option( 'ecw_email_footer_image' ); ?>" />  </span>
<span style="float:<?php echo get_option('ecw_email_footer_text_position');  ?>" > <?php echo get_option( 'ecw_email_footer_text' ); ?> </span>  
</td>                       	
                                </tr>
		<?php
						}
			
				elseif($footer_image){  
						?>
		<tr align="<?php echo get_option('ecw_email_footer_image_position');  ?>" >    
<td style="padding:10px;color:<?php echo $swcm_template_font_color; ?>;">
                                    <!-- Footer -->
<img src="<?php echo get_option( 'ecw_email_footer_image' ); ?>" />  
				<!-- End Footer -->
</td>
		</tr>
<?php } 
elseif($footer_text){           ?>	
			
		<tr align="<?php echo get_option('ecw_email_footer_text_position');  ?>">
<td valign='center' style="padding:10px;color:<?php echo $swcm_template_font_color; ?>;" >
                                    <!-- Footer -->
      <?php echo get_option( 'ecw_email_footer_text' ); ?> 
				<!-- End Footer -->
</td>
		</tr>
<?php } ?>

	
                        </table>

                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
