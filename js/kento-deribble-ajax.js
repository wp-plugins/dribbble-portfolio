jQuery(document).ready(function(jQuery)
	{	
	

		jQuery("#deribble-shots .ds-items-thumbs").click(function()
			{
				var link = jQuery(this).attr("link");
				
				jQuery("#ds-popup").css("display","block");
				jQuery("#ds-popup img").attr("src", link);


			});
			
			
	
		jQuery("#ds-popup").click(function()
			{
				jQuery(this).fadeOut(500);



			});		

			
		

	});