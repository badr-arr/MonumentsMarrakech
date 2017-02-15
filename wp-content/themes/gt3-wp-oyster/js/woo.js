
// Woocommerce Price Filter
setInterval(function woopricefilter() {
	var price_from = jQuery('.price_slider_amount').find('span.from').text();
	var price_to = jQuery('.price_slider_amount').find('span.to').text();
	
	jQuery('.price_slider').find('.ui-slider-handle').first().attr('data-width', price_from);
	jQuery('.price_slider').find('.ui-slider-handle').last().attr('data-width-r', price_to);
	
}, 100);

jQuery(document).ready(function(){		
	jQuery('.woocommerce ul.products li.product, .woocommerce .images .thumbnails a, .woocommerce .images .woocommerce-main-image').each(function(){								
		jQuery(this).find("img").wrapAll('<div class="woo_hover_img"></div>');								
	});
});

jQuery(window).load(function(){
	// Woocommerce //
	jQuery(".woocommerce-page .widget_price_filter .price_slider").wrap("<div class='price_filter_wrap'></div>");	
	jQuery("#tab-additional_information .shop_attributes").wrap("<div class='additional_info'></div>");	
	jQuery(".shop_table.cart").wrap("<div class='woo_shop_cart'></div>");		
});


