<?php 
/*
Template Name: Gallery - Ribbon
*/
if ( !post_password_required() ) {
get_header('fullscreen');
the_post();

$gt3_theme_pagebuilder = gt3_get_theme_pagebuilder(get_the_ID());
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pf = get_post_format();
wp_enqueue_script('gt3_cookie_js', get_template_directory_uri() . '/js/jquery.cookie.js', array(), false, true);
wp_enqueue_script('gt3_swipe_js', get_template_directory_uri() . '/js/jquery.event.swipe.js', array(), false, true);
$all_likes = gt3pb_get_option("likes");
$post_views = (get_post_meta(get_the_ID(), "post_views", true) > 0 ? get_post_meta(get_the_ID(), "post_views", true) : "0");
update_post_meta(get_the_ID(), "post_views", (int)$post_views + 1);
?>
    <div class="fullscreen-gallery hided">
	    <div class="fs_grid_gallery">
		<?php 
            $compile_slides = "";
			$scriptCompile = "";
        if (isset($gt3_theme_pagebuilder['sliders']['fullscreen']['slides']) && is_array($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'])) {        
			$imgi = 1;
			$scriptCompile = '<script> var prImg = [';
            foreach ($gt3_theme_pagebuilder['sliders']['fullscreen']['slides'] as $imageid => $image) {
				if (isset($image['title']['value']) && strlen($image['title']['value'])>0) {
					$photoTitle = ' : '.$image['title']['value'];
					$photoAlt = $image['title']['value'];
				} else {
					$photoTitle = " ";
					$photoAlt = " ";
				}
				if (isset($image['caption']['value']) && strlen($image['caption']['value'])>0) {
					$photoCaption = str_replace(array("\n", "\r"), '<br>', $image['caption']['value']);} else {$photoCaption = "";
				}
				$compile_slides .= "<li data-count='".$imgi."' data-title='". $photoTitle ."' data-caption='". $photoCaption ."' class='slide".$imgi."'><div class='slide_wrapper'><img src='" . aq_resize(wp_get_attachment_url($image['attach_id']), null, "910", true, true, true) . "' alt='". $photoAlt ."'/></div></li>";
				$imgi++;
				$scriptCompile .= "'". aq_resize(wp_get_attachment_url($image['attach_id']), null, "910", true, true, true) ."',";
				?>   
				<?php }
	        }
			$scriptCompile .= "]
			function preImg(imgArray) {
				var perStep = 100/imgArray.length;
				var percent = 0;
				//console.log(imgArray.length +';'+perStep+';'+perStep*imgArray.length);
				for (i = 0; i < imgArray.length; i++) {
					(function (img, src) {
						img.onload = function () {
							percent = percent + perStep;
							//console.log(percent + '% loaded');
							jQuery('.preloader_line').css('width', percent+'%');
							if (percent >= 99) {
								removePreloader();
							}
						};			
						img.src = src;
					} (new Image(), imgArray[i]));
				}				
			}
			</script>";
			echo $scriptCompile;
			?>
            
            <div class="ribbon_wrapper">
                <a href="<?php echo esc_js("javascript:void(0)");?>" class="btn_prev"></a><a href="<?php echo esc_js("javascript:void(0)");?>" class="btn_next"></a>
                <div id="ribbon_swipe"></div>
                <div class="ribbon_list_wrapper">
                    <ul class="ribbon_list">
                        <?php echo $compile_slides; ?>
                    </ul>
                </div>
            </div>
            <div class="slider_info">
            	<div class="slider_data">
	            	<a href="<?php echo esc_js("javascript:void(0)");?>" class="ltl_prev"><i class="icon-angle-left"></i></a><span class="num_current">1</span> <?php _e('of', 'theme_localization'); ?> <span class="num_all"></span><a href="<?php echo esc_js("javascript:void(0)");?>" class="ltl_next"><i class="icon-angle-right"></i></a>
                    <?php if (!isset($gt3_theme_pagebuilder['settings']['show_title']) || $gt3_theme_pagebuilder['settings']['show_title'] !== "no") { ?>
                    <h6 class="slider_title"><?php the_title(); ?></h6><h6 class="slider_caption"></h6>
                    <?php } ?>
                </div>
                <div class="slider_share">
                    <div class="blogpost_share">
                        <span><?php  _e('Share this:', 'theme_localization'); ?></span>
                        <a target="_blank"
                           href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                           class="share_facebook"><i
                                class="stand_icon icon-facebook-square"></i></a>
                        <a target="_blank"
                           href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : gt3_get_theme_option("logo"); ?>"
                           class="share_pinterest"><i class="stand_icon icon-pinterest"></i></a>                                                            
                        <a target="_blank"
                           href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                           class="share_tweet"><i class="stand_icon icon-twitter"></i></a>                                                       
                        <a target="_blank"
                           href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                           class="share_gplus"><i class="icon-google-plus-square"></i></a>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="block_likes">
                    <div class="post-views"><i class="stand_icon icon-eye"></i> <span><?php echo (get_post_meta(get_the_ID(), "post_views", true) > 0 ? get_post_meta(get_the_ID(), "post_views", true) : "0"); ?></span></div>                            
                    <div class="gallery_likes gallery_likes_add <?php echo (isset($_COOKIE['like_port'.get_the_ID()]) ? "already_liked" : ""); ?>" data-attachid="<?php echo get_the_ID(); ?>" data-modify="like_port">
                        <i class="stand_icon <?php echo (isset($_COOKIE['like_port'.get_the_ID()]) ? "icon-heart" : "icon-heart-o"); ?>"></i>
                        <span><?php echo ((isset($all_likes[get_the_ID()]) && $all_likes[get_the_ID()]>0) ? $all_likes[get_the_ID()] : 0); ?></span>
                    </div>											
                </div>                
            </div>
            <!-- .fullscreen_content_wrapper -->            
    	</div>
    </div>
    <script>
		function removePreloader() {
			ribbon_setup();
			setTimeout("jQuery('.ribbon_preloader').addClass('load_done')",500);
			setTimeout("jQuery('.ribbon_preloader').remove()",950);
		}

		jQuery(document).ready(function($){
			preImg(prImg);

            jQuery('.gallery_likes_add').click(function(){
				var gallery_likes_this = jQuery(this);
				if (!jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'))) {
					jQuery.post(gt3_ajaxurl, {
						action:'add_like_attachment',
						attach_id:jQuery(this).attr('data-attachid')
					}, function (response) {
						jQuery.cookie(gallery_likes_this.attr('data-modify')+gallery_likes_this.attr('data-attachid'), 'true', { expires: 7, path: '/' });
						gallery_likes_this.addClass('already_liked');
						gallery_likes_this.find('i').removeClass('icon-heart-o').addClass('icon-heart');
						gallery_likes_this.find('span').text(response);
					});
				}
            });
			jQuery('#ribbon_swipe').on("swipeleft",function(e){
				next_slide();
			});
			jQuery('#ribbon_swipe').on("swiperight",function(e){
				prev_slide();
			});			
			jQuery('.ltl_prev').click(function(){
				prev_slide();
			});
			jQuery('.ltl_next').click(function(){
				next_slide();
			});
			jQuery('.btn_prev').click(function(){
				prev_slide();
			});
			jQuery('.btn_next').click(function(){
				next_slide();
			});

			jQuery('.slide1').addClass('currentStep');
			jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));

			jQuery(document.documentElement).keyup(function (event) {
				if ((event.keyCode == 37) || (event.keyCode == 40)) {
					jQuery('.ltl_prev').click();
				// Right Arrow or Up Arrow
				} else if ((event.keyCode == 39) || (event.keyCode == 38)) {
					jQuery('.ltl_next').click();
				}	
			});	
			
			ribbon_setup();
		});	
		jQuery(window).resize(function($){
			ribbon_setup();
			setTimeout("ribbon_setup()",500);
			setTimeout("ribbon_setup()",1000);			
		});	
		jQuery(window).load(function($){
			ribbon_setup();
			setTimeout("ribbon_setup()",700);
		});	

		function ribbon_setup() {
			setHeight = window_h - header.height() - 20;
			setHeight2 = window_h - header.height() - jQuery('.slider_info').height() - 20;
			jQuery('.fs_grid_gallery').height(window_h - header.height()-1);
			jQuery('.currentStep').removeClass('currentStep');
			jQuery('.slide1').addClass('currentStep');
			jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
			jQuery('.num_current').text('1');
			
			jQuery('.num_all').text(jQuery('.ribbon_list li').size());			
			jQuery('.ribbon_wrapper').height(setHeight2+20);
			jQuery('.ribbon_list .slide_wrapper').height(setHeight2);
			jQuery('.ribbon_list').height(setHeight2).width(20).css('left', 0);
			jQuery('.fs_grid_gallery').width(window_w);
			jQuery('.ribbon_list').find('li').each(function(){
				jQuery('.ribbon_list').width(jQuery('.ribbon_list').width()+jQuery(this).width());
				jQuery(this).attr('data-offset',jQuery(this).offset().left);
				jQuery(this).width(jQuery(this).find('img').width()+parseInt(jQuery(this).find('.slide_wrapper').css('margin-left')));
			});
			max_step = -1*(jQuery('.ribbon_list').width()-window_w);
		}
		function prev_slide() {
			current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
			current_slide--;
			if (current_slide < 1) {
				current_slide = jQuery('.ribbon_list').find('li').size();
			}
			jQuery('.currentStep').removeClass('currentStep');
			jQuery('.num_current').text(current_slide);
			jQuery('.slide'+current_slide).addClass('currentStep');
			jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
			if (-1*jQuery('.slide'+current_slide).attr('data-offset') > max_step) {
				jQuery('.ribbon_list').css('left', -1*jQuery('.slide'+current_slide).attr('data-offset'));
			} else {
				jQuery('.ribbon_list').css('left', max_step);
			}
		}
		function next_slide() {
			current_slide = parseInt(jQuery('.currentStep').attr('data-count'));
			current_slide++;
			if (current_slide > jQuery('.ribbon_list').find('li').size()) {
				current_slide = 1
			}
			jQuery('.currentStep').removeClass('currentStep');
			jQuery('.num_current').text(current_slide);
			jQuery('.slide'+current_slide).addClass('currentStep');
			jQuery('.slider_caption').text(jQuery('.currentStep').attr('data-title'));
			if (-1*jQuery('.slide'+current_slide).attr('data-offset') > max_step) {
				jQuery('.ribbon_list').css('left', -1*jQuery('.slide'+current_slide).attr('data-offset'));
			} else {
				jQuery('.ribbon_list').css('left', max_step);
			}
		}
    </script>
<div class="ribbon_preloader">
	<div class="preloader_line"></div>
</div>
<?php get_footer('fullscreen'); 
} else {
	get_header('fullscreen');
	echo "<div class='fixed_bg' style='background-image:url(".gt3_get_theme_option('bg_img').")'></div>";
?>
    <div class="pp_block">
        <div class="container">
        	<h1 class="pp_title"><?php  _e('THIS CONTENT IS PASSWORD PROTECTED', 'theme_localization') ?></h1>
            <div class="pp_wrapper">
				<?php the_content(); ?>
            </div>
        </div>
    </div>
    <div class="global_center_trigger"></div>	
    <script>
		jQuery(document).ready(function(){
			jQuery('.post-password-form').find('label').find('input').attr('placeholder', 'Enter The Password...');
			jQuery('html').addClass('without_border');
		});

	</script>
		<?php 
	get_footer('fullscreen');
} ?>