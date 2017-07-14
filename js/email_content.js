jQuery( document ).ready( function() {

	jQuery( "#product_delivered_form" ).hide();
	jQuery("#Edit_Product_Delivered").click(function() {
		jQuery( "#ecw_main_page" ).hide();
		jQuery( "#template_preview" ).hide();
		jQuery( "#ECW_main_panel" ).hide();
		jQuery( "#ECW_Home" ).hide();
		jQuery( "#product_delivered_form" ).show();
		return false;
	});

	jQuery("#View_Product_Delivered").click(function() {
                jQuery( "#ecw_main_page" ).show();
                jQuery( "#product_delivered_form" ).hide();
        });


	var ECW_view = jQuery( "#ECW_mail_type_yes" ).val();
	if( ECW_view == "yes" )
	{
		jQuery("#ECW_main_panel" ).hide();
		jQuery( "#ecw_main_title" ).hide();
		jQuery("#ecw_pro_note").hide();
	}

	//Collapse menu
	jQuery('.collapse').on('shown.bs.collapse', function(){
                                jQuery(this).parent().find(".glyphicon-plus").removeClass("glyphicon-plus").addClass("glyphicon-minus");
                                }).on('hidden.bs.collapse', function(){
                                        jQuery(this).parent().find(".glyphicon-minus").removeClass("glyphicon-minus").addClass("glyphicon-plus");
                                        });

});//READY END

//GRAG template variables
function drag(ev) {
    		ev.dataTransfer.setData("text", ev.target.id);
	}

