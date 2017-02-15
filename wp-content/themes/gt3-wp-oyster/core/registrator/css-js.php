<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register()
    {
        $wp_upload_dir = wp_upload_dir();

        #CSS
        wp_enqueue_style('gt3_default_style', get_bloginfo('stylesheet_url'));
        wp_enqueue_style("gt3_theme", get_template_directory_uri() . '/css/theme.css');
        wp_enqueue_style("gt3_responsive", get_template_directory_uri() . '/css/responsive.css');
        if (gt3_get_theme_option("default_skin") == 'skin_dark') {
            wp_enqueue_style('gt3_skin', get_template_directory_uri() . '/css/dark.css');
        }
        wp_enqueue_style("gt3_custom", $wp_upload_dir['baseurl'] . "/" . "custom.css");

        #JS
        wp_enqueue_script("jquery");
        wp_enqueue_script('gt3_theme_js', get_template_directory_uri() . '/js/theme.js', array(), false, true);
    }
}
add_action('wp_enqueue_scripts', 'css_js_register');

/*#Additional files for plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('nextgen-gallery/nggallery.php')) {
    if (!function_exists('nextgen_files')) {
        function nextgen_files()
        {
            wp_enqueue_style("gt3_nextgen", get_template_directory_uri() . '/css/nextgen.css');
            wp_enqueue_script('gt3_nextgen_js', get_template_directory_uri() . '/js/nextgen.js', array(), false, true);
        }
    }
    add_action('wp_enqueue_scripts', 'nextgen_files');
}*/

#Additional files for plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('woocommerce/woocommerce.php')) {
    if (!function_exists('woo_files')) {
        function woo_files()
        {
			$wp_upload_dir = wp_upload_dir();
			
            wp_enqueue_style('css_woo', get_template_directory_uri() . '/css/woo.css');
            wp_enqueue_script('js_woo', get_template_directory_uri() . '/js/woo.js', array(), false, true);
        }
    }
    add_action('wp_print_styles', 'woo_files');
}

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register()
{
    #CSS (MAIN)
    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/core/admin/css/jquery-ui.css');
    wp_enqueue_style('colorpicker_css', get_template_directory_uri() . '/core/admin/css/colorpicker.css');
    wp_enqueue_style('gallery_css', get_template_directory_uri() . '/core/admin/css/gallery.css');
    wp_enqueue_style('colorbox_css', get_template_directory_uri() . '/core/admin/css/colorbox.css');
    wp_enqueue_style('selectBox_css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/core/admin/css/admin.css');
    #CSS OTHER

    #JS (MAIN)
    wp_enqueue_script('admin_js', get_template_directory_uri() . '/core/admin/js/admin.js');
    wp_enqueue_script('ajaxupload_js', get_template_directory_uri() . '/core/admin/js/ajaxupload.js');
    wp_enqueue_script('colorpicker_js', get_template_directory_uri() . '/core/admin/js/colorpicker.js');
    wp_enqueue_script('selectBox_js', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');
    wp_enqueue_script('backgroundPosition_js', get_template_directory_uri() . '/core/admin/js/jquery.backgroundPosition.js');
    wp_enqueue_script(array("jquery-ui-core", "jquery-ui-dialog", "jquery-ui-sortable"));
    wp_enqueue_media();
}

#Data for creating static css/js files.
$text_headers_font = gt3_get_theme_option("text_headers_font");

$main_menu_size = gt3_get_theme_option("menu_font_size");
$main_menu_height = substr(gt3_get_theme_option("menu_font_size"), 0, -2);
$main_menu_height = (int)$main_menu_height + 2;
$main_menu_height = $main_menu_height . "px";

$h1_font_size = gt3_get_theme_option("h1_font_size");
$h1_line_height = substr(gt3_get_theme_option("h1_font_size"), 0, -2);
$h1_line_height = (int)$h1_line_height + 2;
$h1_line_height = $h1_line_height . "px";

$h2_font_size = gt3_get_theme_option("h2_font_size");
$h2_line_height = substr(gt3_get_theme_option("h2_font_size"), 0, -2);
$h2_line_height = (int)$h2_line_height + 2;
$h2_line_height = $h2_line_height . "px";

$h3_font_size = gt3_get_theme_option("h3_font_size");
$h3_line_height = substr(gt3_get_theme_option("h3_font_size"), 0, -2);
$h3_line_height = (int)$h3_line_height + 2;
$h3_line_height = $h3_line_height . "px";

$h4_font_size = gt3_get_theme_option("h4_font_size");
$h4_line_height = substr(gt3_get_theme_option("h4_font_size"), 0, -2);
$h4_line_height = (int)$h4_line_height + 2;
$h4_line_height = $h4_line_height . "px";

$h5_font_size = gt3_get_theme_option("h5_font_size");
$h5_line_height = substr(gt3_get_theme_option("h5_font_size"), 0, -2);
$h5_line_height = (int)$h5_line_height + 2;
$h5_line_height = $h5_line_height . "px";

$h6_font_size = gt3_get_theme_option("h6_font_size");
$h6_line_height = substr(gt3_get_theme_option("h6_font_size"), 0, -2);
$h6_line_height = (int)$h6_line_height + 2;
$h6_line_height = $h6_line_height . "px";

if (gt3_get_theme_option("default_skin") == 'skin_dark') {
    $header_bg = gt3_get_theme_option("header_bg_dark");
    $header_border = gt3_get_theme_option("header_border_dark");
    $slogan = gt3_get_theme_option("slogan_dark");
    $slogan_border = gt3_get_theme_option("slogan_border_dark");
    $main_menu_text_color = gt3_get_theme_option("main_menu_text_color_dark");
    $submenu_bg_color = gt3_get_theme_option("submenu_bg_color_dark");
    $submenu_border_color = gt3_get_theme_option("submenu_border_color_dark");
    $submenu_text_color = gt3_get_theme_option("submenu_text_color_dark");
    $body_bg = gt3_get_theme_option("body_dark");
    $sidebar_bg = gt3_get_theme_option("sidebar_dark");
    $main_text_color = gt3_get_theme_option("main_text_color_dark");
    $header_text_color = gt3_get_theme_option("header_text_color_dark");
    $block_bg = gt3_get_theme_option("block_bg_dark");
    $block_border = gt3_get_theme_option("block_border_dark");
    $footer_bg = gt3_get_theme_option("footer_bg_dark");
    $footer_border = gt3_get_theme_option("footer_border_dark");
    $footer_text = gt3_get_theme_option("footer_text_dark");
    $preloader = gt3_get_theme_option("preloader_bg_dark");
} else {
    $header_bg = gt3_get_theme_option("header_bg_light");
    $header_border = gt3_get_theme_option("header_border_light");
    $slogan = gt3_get_theme_option("slogan_light");
    $slogan_border = gt3_get_theme_option("slogan_border_light");
    $main_menu_text_color = gt3_get_theme_option("main_menu_text_color_light");
    $submenu_bg_color = gt3_get_theme_option("submenu_bg_color_light");
    $submenu_border_color = gt3_get_theme_option("submenu_border_color_light");
    $submenu_text_color = gt3_get_theme_option("submenu_text_color_light");
    $body_bg = gt3_get_theme_option("body_light");
    $sidebar_bg = gt3_get_theme_option("sidebar_light");
    $main_text_color = gt3_get_theme_option("main_text_color_light");
    $header_text_color = gt3_get_theme_option("header_text_color_light");
    $block_bg = gt3_get_theme_option("block_bg_light");
    $block_border = gt3_get_theme_option("block_border_light");
    $footer_bg = gt3_get_theme_option("footer_bg_light");
    $footer_border = gt3_get_theme_option("footer_border_light");
    $footer_text = gt3_get_theme_option("footer_text_light");
    $preloader = gt3_get_theme_option("preloader_bg_light");
}

$custom_css = new cssJsGenerator(
    $filename = "custom.css",
    $filetype = "css",
    $output = '
	/* SKIN COLORS */
	.bg_sidebar {
		background:#' . $sidebar_bg . ';
	}
	.main_header {
		background:#' . $header_bg . ';
		border-bottom:#' . $header_border . ' 1px solid;
	}
	.header_search input {
		background:#' . $header_bg . '!important;
		border:#' . $header_border . ' 1px solid!important;
	}
	.main_header nav .search_fadder {
		background:rgba(' . gt3_HexToRGB($header_bg) . ',0);
	}
	.main_header.search_on nav .search_fadder {
		background:rgba(' . gt3_HexToRGB($header_bg) . ',1);
	}
	.logo_sect .slogan {
		border-left:#' . $slogan_border . ' 1px solid;
		color:#' . $slogan . ';
	}
	.main_header nav ul.menu > li > a {
		color:#' . $main_menu_text_color . ';
	}
	ul.mobile_menu li a {
		color:#' . $main_menu_text_color . '!important;
	}
	.main_header nav ul.menu .sub-menu {
		background:#' . $submenu_bg_color . ';
		border:#' . $submenu_border_color . ' 1px solid;
	}
	.main_header nav ul.menu > li > .sub-menu:before {
	    border-bottom:#' . $submenu_bg_color . ' 5px solid;
	}
	.main_header nav ul.menu > li > .sub-menu:after {
	    border-bottom:#' . $submenu_border_color . ' 5px solid;
	}
	.main_header nav .sub-menu a {
		color:#' . $submenu_text_color . ';
	}
	ul.mobile_menu .sub-menu a {
		color:#' . $submenu_text_color . '!important;
	}
	footer {
		background:#' . $footer_bg . ';
		border-top:#' . $footer_border . ' 1px solid;
	}
	footer .copyright {
		color:#' . $footer_text . ';
	}

	h5.shortcode_accordion_item_title,
	h5.shortcode_toggles_item_title,
	h5.shortcode_accordion_item_title.state-active {
		color:#' . $main_text_color . '!important;
	}
	h5.shortcode_accordion_item_title,
	h5.shortcode_toggles_item_title,
	.featured_posts .item_wrapper,
	.featured_portfolio .item_wrapper,
	.columns1 .gallery_item_wrapper,
	.list-of-images .gallery_item_wrapper,
	.shortcode_tab_item_title:hover,
	.shortcode_tab_item_title.active,
	.all_body_cont,
	.shortcode_messagebox,
	.price_item,
	.before-after,
	.promoblock_wrapper,
	.module_team .item,
	.post_preview_wrapper,
	.box_date .box_day,
	.pagerblock li a,
	.blog_post_page,
	.blogpost_user_meta,
	.portfolio_item_block,
	.fw_preview_wrapper,
	.cont_gallery_wrapper,
	.fw-blog_post-footer,
	.sp-blog_post-footer,
	.load_more_works,
	.album_item,
	.album-pseudo1,
	.album-pseudo2 {
		background: #' . $block_bg . ';
		border:#' . $block_border . ' 1px solid;
	}
	.shortcode_tab_item_title {
		border:#' . $block_border . ' 1px solid;
	}
	.shortcode_messagebox:before {
		background:#' . $block_border . ';
	}
	.shortcode_tab_item_title.active:before,
	.beforeAfter_wrapper .result_line:after,
	.beforeAfter_wrapper .result_line:before,
	.fw_content_wrapper {
		background: #' . $block_bg . ';
	}
	.fw_content_wrapper {
		background:rgba(' . gt3_HexToRGB($block_bg) . ', '. gt3_get_theme_option("fw_content_opacity") .');
	}
	.price_item .price_item_title {
		border-bottom:#' . $block_border . ' 1px solid;
	}

	.preloader,
	.ribbon_preloader  {
		background:#' . $preloader . ';
	}

    /* CSS HERE */
	body,
	.shortcode_tab_item_title,
	.ww_block canvas,
	#whaterwheel {
		background:#' . $body_bg . ';
	}
	p, td, div,
	.blogpost_share a:hover,
	.optionset li.selected a,
	.btn_back,
	.widget_nav_menu ul li a,
	.widget_archive ul li a,
	.widget_pages ul li a,
	.widget_categories ul li a,
	.widget_recent_entries ul li a,
	.widget_meta ul li a {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	a:hover,
	.chart,
	.blogpreview_top .listing_meta span a:hover,
	.pagerblock li a,
	.prev_next_links div a:hover,
	.prev_next_links div a:hover:before,
	.prev_next_links div a:hover:after,
	.ltl_next,
	.ltl_prev,
	.widget_posts .post_title {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.slider_data h6,
	.slider_info .listing_meta a:hover {
		color:#' . $main_text_color . '!important;
	}

	.main_header nav ul.menu > li > a {
		color:#' . $main_menu_text_color . ';
	}
	.main_header nav ul.sub-menu li a {
		color:#' . $submenu_text_color . ';
	}

	::selection {background:#' . gt3_get_theme_option("theme_color1") . ';}
	::-moz-selection {background:#' . gt3_get_theme_option("theme_color1") . ';}

	.main_header nav ul.sub-menu > li:hover > a,
	.main_header nav ul.sub-menu > li.current-menu-item > a,
	.main_header nav ul.sub-menu > li.current-menu-parent > a,
	.iconbox_wrapper .ico i,
	.shortcode_iconbox a:hover .iconbox_body,
	.shortcode_iconbox a:hover .iconbox_body p,
	.shortcode_iconbox a:hover .iconbox_title,
	a,
	blockquote.shortcode_blockquote.type5:before,
	.main_header nav ul.menu > li:hover > a,
	.main_header nav ul.menu > li.current-menu-ancestor > a,
	.main_header nav ul.menu > li.current-menu-item > a,
	.main_header nav ul.menu > li.current-menu-parent > a,
	.dropcap.type2,
	.dropcap.type5,
	.featured_items_title a:hover,
	.shortcode_tab_item_title:hover,
	.counter_wrapper .ico_wrapper i,
	.most_popular .price_item_cost h1,
	.most_popular .price_item_cost h4,
	.pagerblock li a:hover,
	.blogpost_title a:hover,
	.optionset li a:hover,
	.portfolio_content h6 a:hover,
	.portfolio_dscr_top a:hover,
	.grid-port-cont h6 a:hover,
	.btn_back:hover,
	.fs_sharing a:hover,
	.count_ico:hover i,
	.ltl_prev:hover,
	.ltl_next:hover,
	.widget_nav_menu ul li a:hover,
	.widget_archive ul li a:hover,
	.widget_pages ul li a:hover,
	.widget_categories ul li a:hover,
	.widget_recent_entries ul li a:hover,
	.widget_meta ul li a:hover,
	.widget_posts .post_title:hover,
	.album_item-title a:hover {	
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}

	h5.shortcode_accordion_item_title:hover,
	h5.shortcode_toggles_item_title:hover,
	.comment-reply-link:hover:before,
	.comment_info a:hover,
	.portfolio_dscr_top a:hover,
	ul.mobile_menu > li:hover > a,
	ul.mobile_menu > li.current-menu-ancestor > a,
	ul.mobile_menu > li.current-menu-item > a,
	ul.mobile_menu > li.current-menu-parent > a,
	.mobile_menu ul.sub-menu > li:hover > a,
	.mobile_menu ul.sub-menu > li.current-menu-item > a,
	.mobile_menu ul.sub-menu > li.current-menu-parent > a {
		color:#' . gt3_get_theme_option("theme_color1") . '!important;
	}

	.highlighted_colored,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	.shortcode_button.btn_type5,
	.shortcode_button.btn_type1:hover,
	.shortcode_button.btn_type1_dark:hover,
	.shortcode_button.btn_type4:hover,
	.main_header nav ul.menu > li > a:before,
	h5.shortcode_accordion_item_title:hover .ico:before,
	h5.shortcode_toggles_item_title:hover .ico:before,
	h5.shortcode_accordion_item_title:hover .ico:after,
	h5.shortcode_toggles_item_title:hover .ico:after,
	.box_date .box_month,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.search404 .search_button,
	.preloader_line {
		background-color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.preloader:after {
		background-color:#' . gt3_get_theme_option("preloader_color") . ';
	}
	#mc_signup_submit:hover {
		background-color:#' . gt3_get_theme_option("theme_color1") . '!important;
	}
	.shortcode_button.btn_type4:hover {
		box-shadow:inset 1px 1px 0 #' . gt3_get_theme_option("theme_color1") . ', inset -1px -1px 0 #' . gt3_get_theme_option("theme_color1") . ', inset 0 -1px 0 #' . gt3_get_theme_option("theme_color1") . ', inset -1px 0 0 #' . gt3_get_theme_option("theme_color1") . ';
	}
	blockquote.shortcode_blockquote.type5 .blockquote_wrapper,
	.widget_tag_cloud a:hover,
	.columns2 .portfolio_item .portfolio_item_wrapper h5,
	.columns3 .portfolio_item .portfolio_item_wrapper h5,
	.columns4 .portfolio_item .portfolio_item_wrapper h5,
	.fs_blog_top,
	.simple-post-top,
	.widget_search .search_form,
	.module_cont hr.type3,
	blockquote.shortcode_blockquote.type2 {
		border-color:#' . gt3_get_theme_option("theme_color1") . ';
	}

	.widget_flickr .flickr_badge_image a .flickr_fadder {
		background:rgba(' . gt3_HexToRGB(gt3_get_theme_option("theme_color1")) . ',0);
	}
	.widget_flickr .flickr_badge_image a:hover .flickr_fadder {
		background:rgba(' . gt3_HexToRGB(gt3_get_theme_option("theme_color1")) . ',0.6);
	}


	/*Fonts Families and Sizes*/
	* {
		font-family:' . gt3_get_theme_option("main_content_font") . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	p, td, div,
	blockquote p,
	input {
		font-size:' . gt3_get_theme_option("main_content_font_size") . ';
		line-height:' . gt3_get_theme_option("main_content_line_height") . ';
	}
	.main_header nav ul.menu > li > a {
		font-size:'.$main_menu_size.';
		line-height: '.$main_menu_height.';
	}
	h1, h2, h3, h4, h5, h6,
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
		font-family: ' . $text_headers_font . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;    
		text-decoration:none!important;
		padding:0;
		color:#' . $header_text_color . ';
	}
	.sidebar_header {
		font-family:' . gt3_get_theme_option("main_content_font") . ';
	}	
	.load_more_works {
		font-family: ' . $text_headers_font . ';
		color:#' . $header_text_color . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	.box_date span,
	.countdown-row .countdown-section:before,
	.countdown-amount,
	.countdown-period {
		font-family: ' . $text_headers_font . ';
	}
	.iconbox_header .ico i,
	.title,
	.comment-reply-link:before,
	.ww_footer_right .blogpost_share span {
		color:#' . $header_text_color . ';
	}
	a.shortcode_button,
	.chart.easyPieChart,
	.chart.easyPieChart span,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.search404 .search_button {
		font-family: ' . $text_headers_font . ';
	}
	h1, h2, h3, h4, h5, h6,
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
		font-weight:' . gt3_get_theme_option("headings_weight") . ';
	}
	h4,
	h4 span,
	h4 a,
	h4 a:hover,
	h3.comment-reply-title {
		font-weight:500;
	}
	
	input[type="button"],
	input[type="reset"],
	input[type="submit"] {
		font-weight:900;
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased; 		
	}
	h1, h1 span, h1 a {
		font-size:' . $h1_font_size . ';
		line-height:' . $h1_line_height . ';
	}
	h2, h2 span, h2 a {
		font-size:' . $h2_font_size . ';
		line-height:' . $h2_line_height . ';
	}
	h3, h3 span, h3 a {
		font-size:' . $h3_font_size . ';
		line-height:' . $h3_line_height . ';
	}
	h4, h4 span, h4 a, 
	h3.comment-reply-title {
		font-size:' . $h4_font_size . ';
		line-height:' . $h4_line_height . ';
	}
	h5, h5 span, h5 a {
		font-size:' . $h5_font_size . ';
		line-height:' . $h5_line_height . ';
	}
	h6, h6 span, h6 a,
	.comment_info h6:after {
		font-size:' . $h6_font_size . ';
		line-height:' . $h6_line_height . ';
	}
	@media only screen and (max-width: 760px) {
		.fw_content_wrapper {
			background:#' . $body_bg . '!important;
		}
	}
	
	/* Woocommerce css */
	.woocommerce_container h1.page-title {
		font-size:' . $h1_font_size . ';
		line-height:' . $h1_line_height . ';
		font-weight:' . gt3_get_theme_option("headings_weight") . ';		
	}
	.woocommerce .woocommerce_container ul.products li.product,
	.woocommerce .woocommerce_container .upsells.products ul li.product,
	.woocommerce ul.products li.product,
	.woocommerce .upsells.products ul li.product {
		background: #' . $block_bg . ';
		border:#' . $block_border . ' 1px solid;
	}	
	nav.woocommerce-pagination ul.page-numbers li a,
	nav.woocommerce-pagination ul.page-numbers li span {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
		background: #' . $block_bg . ' !important;
		border:#' . $block_border . ' 1px solid;
	}
	nav.woocommerce-pagination ul.page-numbers li a:hover,
	nav.woocommerce-pagination ul.page-numbers li a:focus {color:#'.gt3_get_theme_option("theme_color1").' !important;
	}
	.woocommerce_container ul.products li.product a.add_to_cart_button:before,
	.woocommerce_container ul.products li.product a.add_to_cart_button.loading:before,
	.woocommerce_container ul.products li.product a.product_type_variable:before,
	.woocommerce_container ul.products li.product a.product_type_grouped:before,
	.woocommerce ul.products li.product a.add_to_cart_button:before,
	.woocommerce ul.products li.product a.add_to_cart_button.loading:before,
	.woocommerce ul.products li.product a.product_type_variable:before,
	.woocommerce ul.products li.product a.product_type_grouped:before {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ' !important;
		font-family:' . gt3_get_theme_option("main_content_font") . ' !important;
	}
	.woocommerce_container ul.products li.product a.add_to_cart_button:after,
	.woocommerce_container ul.products li.product a.add_to_cart_button.loading:after,
	.woocommerce_container ul.products li.product a.product_type_variable:after,
	.woocommerce_container ul.products li.product a.product_type_grouped:after,
	.woocommerce ul.products li.product a.add_to_cart_button:after,
	.woocommerce ul.products li.product a.add_to_cart_button.loading:after,
	.woocommerce ul.products li.product a.product_type_variable:after,
	.woocommerce ul.products li.product a.product_type_grouped:after {
		color:#' . $main_text_color . ';
	}
	.woocommerce_container ul.products li.product a.add_to_cart_button:hover:before,
	.woocommerce_container ul.products li.product a.add_to_cart_button.loading:hover:before,
	.woocommerce_container ul.products li.product a.product_type_variable:hover:before,
	.woocommerce_container ul.products li.product a.product_type_grouped:hover:before,
	.woocommerce ul.products li.product a.add_to_cart_button:hover:before,
	.woocommerce ul.products li.product a.add_to_cart_button.loading:hover:before,
	.woocommerce ul.products li.product a.product_type_variable:hover:before,
	.woocommerce ul.products li.product a.product_type_grouped:hover:before,
	.woocommerce_container ul.products li.product a.add_to_cart_button:hover:after,
	.woocommerce_container ul.products li.product a.add_to_cart_button.loading:hover:after,
	.woocommerce_container ul.products li.product a.product_type_variable:hover:after,
	.woocommerce_container ul.products li.product a.product_type_grouped:hover:after,
	.woocommerce ul.products li.product a.add_to_cart_button:hover:after,
	.woocommerce ul.products li.product a.add_to_cart_button.loading:hover:after,
	.woocommerce ul.products li.product a.product_type_variable:hover:after,
	.woocommerce ul.products li.product a.product_type_grouped:hover:after {
		color:#'.gt3_get_theme_option("theme_color1").';
	}
	.woocommerce_container ul.products li.product h3,
	.woocommerce ul.products li.product h3 {
		color: #' . $header_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ' !important;
		font-family:' . gt3_get_theme_option("main_content_font") . ';
	}
	.woocommerce_container ul.products li.product h3:hover,
	.woocommerce ul.products li.product h3:hover {color: #'.gt3_get_theme_option("theme_color1").' !important;
	}
	.woocommerce_container ul.products li.product .amount,
	.woocommerce ul.products li.product .amount {
		font-weight:' . gt3_get_theme_option("content_weight") . ' !important;
		font-family:' . gt3_get_theme_option("main_content_font") . ' !important;
	}
	.woocommerce_container ul.products li.product .price ins,
	.woocommerce_container ul.products li.product .price ins .amount,
	.woocommerce ul.products li.product .price ins,
	.woocommerce ul.products li.product .price ins .amount,
	.woocommerce_container ul.products li.product .price .amount,
	.woocommerce ul.products li.product .price .amount {color: #'.gt3_get_theme_option("theme_color1").' !important;
	}
	.woo_wrap ul.cart_list li a, .woo_wrap ul.product_list_widget li a,
	.woocommerce ul.product_list_widget li a {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.woo_wrap ul.cart_list li a:hover, .woo_wrap ul.product_list_widget li a:hover,
	.woocommerce ul.product_list_widget li a:hover {
		color: #'.gt3_get_theme_option("theme_color1").' !important;
	}
	.woocommerce-page .widget_shopping_cart .empty {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.woo_wrap .widget_shopping_cart .total {color:#' . $main_text_color . ';
	}
	.woocommerce a.button, .woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #content input.button, .woocommerce a.edit,
	.woocommerce-page input.button {
		font-family: "'. $text_headers_font .'";
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;
	}
	.woocommerce a.button:hover, .woocommerce button.button:hover,
	.woocommerce input.button:hover,
	.woocommerce #content input.button:hover, .woocommerce a.edit:hover,
	.woocommerce-page input.button:hover {
		background:#'.gt3_get_theme_option("theme_color1").' !important;	
	}	
	.woocommerce input[type="reset"],
	.woocommerce input[type="submit"],
	.woocommerce input.button,
	.woocommerce button.button {
		background:#'.gt3_get_theme_option("theme_color1").' !important;
		font-family: "'. $text_headers_font .'";
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;
	}		
	.woocommerce .button.alt, .woocommerce .pay {background:#'.gt3_get_theme_option("theme_color1").' !important;	
	}
	.woocommerce .shop_table.cart .actions .button:hover,
	.woocommerce .shop_table.cart .actions .button.checkout-button,
	.dark_version .woocommerce .shop_table.cart .actions .button.checkout-button,
	.dark_version .woocommerce .shop_table.cart .actions .button:hover {
		background-color:#'.gt3_get_theme_option("theme_color1").' !important;
	}	
	.widget_product_categories a, .widget_login .pagenav a, .woocommerce-page .widget_nav_menu ul li a {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.widget_product_categories a:hover,
	.widget_product_categories li.current-cat a,
	.widget_login .pagenav a:hover,
	.woocommerce-page .widget_nav_menu ul li a:hover,
	.widget_layered_nav li:hover, .widget_layered_nav li.chosen,
	.widget_layered_nav li:hover a, .widget_layered_nav li.chosen a,
	.woocommerce .widget_layered_nav ul li.chosen a,
	.woocommerce-page .widget_layered_nav ul li.chosen a {color:#'.gt3_get_theme_option("theme_color1").' !important;
	}
	.widget_layered_nav li,
	.widget_layered_nav li a,
	.widget_layered_nav li small.count {color:#' . $main_text_color . ';
	}
	.woo_wrap .price_label span {color:#' . $main_text_color . ';
	}
	.widget_price_filter .price_slider_amount .button:hover,
	.dark_version .widget_price_filter .price_slider_amount .button:hover {background:#'.gt3_get_theme_option("theme_color1").' !important;
	}
	.right-sidebar-block .total .amount,
	.left-sidebar-block .total .amount {color:#' . $main_text_color . ' !important;
	}
	.right-sidebar-block del, .right-sidebar-block ins, .right-sidebar-block .amount,
	.left-sidebar-block del, .left-sidebar-block ins, .left-sidebar-block .amount,
	.right-sidebar-block ins .amount, .left-sidebar-block ins .amount {color:#' . $main_text_color . ';
	}
	.woocommerce .woocommerce_message, .woocommerce .woocommerce_error, .woocommerce .woocommerce_info,
	.woocommerce .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info {
		background: #' . $block_bg . ';
		border:#' . $block_border . ' 1px solid;
	}
	.woocommerce .woocommerce_message, .woocommerce .woocommerce-message,
	.woocommerce .woocommerce_message a, .woocommerce .woocommerce-message a {color:#' . $main_text_color . ';
	}
	.woocommerce .woocommerce_message:before,
	.woocommerce .woocommerce-message:before {
		color: #' . $main_text_color . ';
	}
	.woocommerce .woocommerce_message:after, .woocommerce .woocommerce_error:after, .woocommerce .woocommerce_info:after,
	.woocommerce .woocommerce-message:after, .woocommerce .woocommerce-error:after, .woocommerce .woocommerce-info:after {background: #' . $block_border . ';
	}
	.images .woocommerce-main-image.zoom,
	.thumbnails .woo_hover_img {
		background: #' . $block_bg . ';
		border:#' . $block_border . ' 1px solid;
	}
	.woocommerce_container h1.product_title {border-bottom:1px #' . $block_border . ' solid;
	}
	.woocommerce div.product span.price,
	.woocommerce div.product p.price,
	.woocommerce #content div.product span.price,
	.woocommerce #content div.product p.price,
	div.product .amount {
		font-family: "'. $text_headers_font .'";
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;
	}
	div.product .amount {color:#' . $header_text_color . ';
	}
	.woocommerce-review-link {color:#'.gt3_get_theme_option("theme_color1").';
	}
	.woocommerce .quantity input.qty, .woocommerce #content .quantity input.qty,
	.variations td label,
	.woocommerce-review-link:hover {color:#' . $main_text_color . ';
	}	
	.summary .product_meta span a:hover {color:#' . $main_text_color . ' !important;
	}
	.woocommerce .quantity .plus:hover,
	.woocommerce .quantity .minus:hover,
	.woocommerce #content .quantity .plus:hover,
	.woocommerce #content .quantity .minus:hover,
	.woocommerce .woo_shop_cart .quantity .plus:hover,
	.woocommerce .woo_shop_cart .quantity .minus:hover,
	.woocommerce #content .woo_shop_cart .quantity .plus:hover,
	.woocommerce #content .woo_shop_cart .quantity .minus:hover,
	.dark_version.woocommerce .quantity .plus:hover,
	.dark_version.woocommerce .quantity .minus:hover,
	.dark_version.woocommerce #content .quantity .plus:hover,
	.dark_version.woocommerce #content .quantity .minus:hover,
	.dark_version .woocommerce .woo_shop_cart .quantity .plus:hover,
	.dark_version .woocommerce .woo_shop_cart .quantity .minus:hover,
	.dark_version .woocommerce #content .woo_shop_cart .quantity .plus:hover,
	.dark_version .woocommerce #content .woo_shop_cart .quantity .minus:hover,
	.woocommerce table.cart a.remove:hover,
	.woocommerce #content table.cart a.remove:hover,
	.dark_version .woocommerce table.cart a.remove:hover,
	.dark_version .woocommerce #content table.cart a.remove:hover {background-color:#'.gt3_get_theme_option("theme_color1").' !important;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li {
		background:#' . $body_bg . ';
		color:#' . $main_text_color . ';
		border:#' . $block_border . ' 1px solid;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li:hover,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li:hover {background: #' . $block_bg . ';	
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li:hover a, 
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active:hover a,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active:hover a {color:#'.gt3_get_theme_option("theme_color1").';
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li a {color:#' . $main_text_color . ';
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active {
		background:#' . $block_bg . ' !important;
		border-bottom-color:#' . $block_bg . ' !important;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:hover,
	.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active a:hover {color: #' . $main_text_color . ' !important;
	}
	.woocommerce div.product .woocommerce-tabs .panel,
	.woocommerce #content div.product .woocommerce-tabs .panel {
		background: #' . $block_bg . ';
		color:#' . $main_text_color . ';
		border:#' . $block_border . ' 1px solid;
	}
	.woocommerce div.product .woocommerce-tabs .panel p,
	.woocommerce #content div.product .woocommerce-tabs .panel p {color:#' . $main_text_color . ';
	}
	.woocommerce div.product .woocommerce-tabs .panel h2,
	.woocommerce #content div.product .woocommerce-tabs .panel h2 {
		font-family:' . gt3_get_theme_option("main_content_font") . ';
	}
	.woocommerce div.product .woocommerce-tabs .panel a:hover,
	.woocommerce #content div.product .woocommerce-tabs .panel a:hover {color:#' . $header_text_color . ' !important;
	}
	.woocommerce table.shop_attributes th:after,
	.woocommerce table.shop_attributes td:after {background:#' . $block_border . ';
	}
	.woocommerce .woocommerce-tabs #reviews #reply-title {
		font-family:' . gt3_get_theme_option("main_content_font") . ';
	}	
	.woocommerce #reviews #comments ol.commentlist li .comment-text .meta strong,
	.woocommerce .woocommerce-tabs #reviews #comments ol.commentlist li .comment-text .meta strong,
	.woocommerce .woocommerce-tabs #reviews #comments ol.commentlist li .comment-text .meta time {color:#' . $header_text_color . ' !important;
	}		
	mark {background:#'.gt3_get_theme_option("theme_color1").';
	}
	.woocommerce table.shop_table {
		background:#' . $block_bg . ';
		border: 1px solid #' . $block_border . ';
	}
	.woocommerce table.shop_table tr {border-top: 1px solid #' . $block_border . ';
	}
	#ship-to-different-address {
		color:#' . $main_text_color . ' !important;
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.woocommerce #payment ul li {
		color:#' . $main_text_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.woocommerce form.checkout_coupon {
		background:#' . $block_bg . ';
		border:1px #' . $block_border . ' solid;
	}
	.woocommerce table.shop_table td.product-remove,
	.woocommerce table.shop_table .product-quantity,
	.woocommerce table.shop_table .product-price,
	.woocommerce table.shop_table .product-name {border-right:1px #' . $block_border . ' solid !important;
	}
	.shop_table .product-subtotal .amount,
	.shop_table .product-price .amount {color:#' . $header_text_color . ';
	}
	.shop_table .product-name a {color:#' . $main_text_color . ';
	}
	.shop_table .product-name a:hover {color:#'.gt3_get_theme_option("theme_color1").';
	}
	.woocommerce .cart-collaterals .order-total .amount {color:#'.gt3_get_theme_option("theme_color1").';
	}
	.shipping-calculator-button {
		font-family: "'. $text_headers_font .'";
	}
    '
);

?>