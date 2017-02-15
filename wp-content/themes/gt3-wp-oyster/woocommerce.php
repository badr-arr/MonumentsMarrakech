<?php 
get_header(); 
$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$gt3_theme_pagebuilder['settings']['selected-sidebar-name'] = "WooCommerce";
if ($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar" || $gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar") {
	echo '<div class="bg_sidebar is_'. $gt3_theme_pagebuilder['settings']['layout-sidebars'] .'"></div>';
}
?>
<div class="content_wrapper">
	<div class="container">
        <div class="content_block woo_wrap row <?php echo $gt3_theme_pagebuilder['settings']['layout-sidebars'] ?>">
            <div class="fl-container <?php echo(($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "right-sidebar") ? "hasRS" : ""); ?>">
                <div class="row">
                    <div class="posts-block <?php echo($gt3_theme_pagebuilder['settings']['layout-sidebars'] == "left-sidebar" ? "hasLS" : ""); ?>">
                        <div class="contentarea woocommerce_container">
                            <?php
                            woocommerce_content();
                            wp_link_pages(array('before' => '<div class="page-link">' . __('Pages', 'theme_localization') . ': ', 'after' => '</div>'));
                            ?>
                        </div>
                    </div>
                    <?php get_sidebar('left'); ?>
                </div>
            </div>
            <?php get_sidebar('right'); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>