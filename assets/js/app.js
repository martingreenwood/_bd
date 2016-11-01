// Set default value to 0 for Custom price input
jQuery(document).ready(function(){
    jQuery('.ywcnp_sugg_price').val("25");
});

jQuery(document).ready(function(){
    jQuery('.product-addon-final-trimmed-print-size input').attr({
    	placeholder: 'Height (mm) x Width (mm)'
    });
});

jQuery(document).ready(function(){
	
	function owlLoaded() {
		setTimeout(function() {
			var o = jQuery('.owl-carousel').data('owlCarousel');
			if(o) {
				o.onResize();
			}
		}, 500);
	}
	
	jQuery(".thumbnails").addClass("owl-carousel");
	jQuery(".thumbnails").owlCarousel({
		loop:true,
		items:1,
		onInitialized: owlLoaded,
	});


	jQuery('#workshop-menu').change(function() {
		
		var id = jQuery(this).val();
		jQuery('.workshop-item').hide();
		jQuery("#" + id).show();
		
	});
	
	jQuery('#workshop-menu').change();
	
});