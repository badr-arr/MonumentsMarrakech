<?php
#gt3_delete_theme_option("theme_version");

$theme_temp_version = gt3_get_theme_option("theme_version");
 
if ((int)$theme_temp_version < 5) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");

	gt3_update_theme_option('default_fit_style', 'no_fit');
	gt3_update_theme_option('default_controls', 'on');
	gt3_update_theme_option('default_autoplay', 'on');
	gt3_update_theme_option('gallery_interval', 3000);

	gt3_update_theme_option("theme_version", 5);
}
if ((int)$theme_temp_version < 6) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");

	gt3_update_theme_option('preloader_bg_dark', '272b31');
	gt3_update_theme_option('preloader_bg_light', 'ffffff');

	gt3_update_theme_option("theme_version", 6);
}
if ((int)$theme_temp_version < 7) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");

	gt3_update_theme_option('fw_content_opacity', '1');

	gt3_update_theme_option("theme_version", 7);
}
if ((int)$theme_temp_version < 8) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");

	gt3_update_theme_option('preloader_color', '40b7b8');

	gt3_update_theme_option("theme_version", 8);
}
if ((int)$theme_temp_version < 9) {
	gt3_update_theme_option("custom.css_request_recompile_file", "yes");
	gt3_update_theme_option("theme_version", 9);
}
?>