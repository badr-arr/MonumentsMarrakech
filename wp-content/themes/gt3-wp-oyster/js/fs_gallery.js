var fs_body = jQuery('body');

jQuery.fn.fs_gallery = function (fs_options) {
    //Set Variables
    var fs_el = jQuery(this),
        fs_base = this;
    var fs_interval = setInterval('nextSlide()', fs_options.slide_time);

	if (fs_options.autoplay == 0) {
		playpause = "fs_play";
		clearInterval(fs_interval);
	} else {
		playpause = "fs_pause";
	}
	if (fs_options.show_controls == 0) {
		show_class = 'hide_me';
		controls_class = 'open_controls';
	} else {
		show_class = '';
		controls_class = '';
	}
	if (jQuery('.no_fs_controls').size() > 0) {
		jQuery('.main_header').addClass('hide_me');
	}
    fs_body.append('<div class="fs_gallery_wrapper"><ul class="' + fs_options.fit + ' fs_gallery_container ' + fs_options.fx + '"/></div>');
    fs_container = jQuery('.fs_gallery_container');
    jQuery('body').append('<div class="fs_title_wrapper ' + show_class + '"><h1 class="fs_title"></h1><h3 class="fs_descr"></h3></div>');
    jQuery('body').append('<div class="fs_thmb_viewport ' + show_class + '"><div class="fs_thmb_wrapper"><ul class="fs_thmb_list" style="width:' + fs_options.slides.length * 128 + 'px"></ul></div></div>');
    fs_thmb = jQuery('.fs_thmb_list');	
	if (fs_options.autoplay == 0) {
		fs_thmb.addClass('paused');
	}	
    fs_thmb_viewport = jQuery('.fs_thmb_viewport');
    $fs_title = jQuery('.fs_title');
    $fs_descr = jQuery('.fs_descr');

    thisSlide = 0;
    while (thisSlide <= fs_options.slides.length - 1) {
        if (fs_options.slides[thisSlide].type == "image") {
            fs_container.append('<li class="fs_slide slide' + thisSlide + '" data-count="' + thisSlide + '" data-src="' + fs_options.slides[thisSlide].image + '" data-type="' + fs_options.slides[thisSlide].type + '"></li>');
        } else if (fs_options.slides[thisSlide].type == "youtube") {
            fs_container.append('<li class="fs_slide yt_slide video_slide slide' + thisSlide + '" data-count="' + thisSlide + '" data-bg="' + fs_options.slides[thisSlide].thmb + '" data-src="' + fs_options.slides[thisSlide].src + '" data-type="' + fs_options.slides[thisSlide].type + '"></li>');
        } else {
            fs_container.append('<li class="fs_slide video_slide slide' + thisSlide + '" data-id="player' + fs_options.slides[thisSlide].uniqid + '" data-count="' + thisSlide + '" data-bg="' + fs_options.slides[thisSlide].thmb + '" data-src="' + fs_options.slides[thisSlide].src + '" data-type="' + fs_options.slides[thisSlide].type + '"></li>');
        }

        if (fs_options.slides[thisSlide].type == "image") {
            fs_thmb.append('<li class="fs_slide_thmb slide' + thisSlide + '" data-count="' + thisSlide + '"><img alt="' + fs_options.slides[thisSlide].alt + ' ' + thisSlide + '" src="' + fs_options.slides[thisSlide].thmb + '"/><div class="fs_thmb_fadder"></div></li>');
        } else if (fs_options.slides[thisSlide].type == "youtube") {
            fs_thmb.append('<li class="fs_slide_thmb video_thmb yt_thmb slide' + thisSlide + '" data-count="' + thisSlide + '"><img alt="' + fs_options.slides[thisSlide].alt + ' ' + thisSlide + '" src="' + fs_options.slides[thisSlide].thmb + '"/><div class="fs_thmb_fadder"></div></li>');
        } else {
            fs_thmb.append('<li class="fs_slide_thmb video_thmb slide' + thisSlide + '" data-count="' + thisSlide + '"><img alt="' + fs_options.slides[thisSlide].alt + ' ' + thisSlide + '" src="' + fs_options.slides[thisSlide].thmb + '"/><div class="fs_thmb_fadder"></div></li>');
        }
        thisSlide++;
    }
    fs_container.find('li.slide0').addClass('current-slide').attr('style', 'background:url(' + fs_container.find('li.slide0').attr('data-src') + ') no-repeat;');
    fs_container.find('li.slide1').attr('style', 'background:url(' + fs_container.find('li.slide1').attr('data-src') + ') no-repeat;');
    $fs_title.html(fs_options.slides[0].title).css('color', fs_options.slides[0].titleColor);
    $fs_descr.html(fs_options.slides[0].description).css('color', fs_options.slides[0].descriptionColor);
	
   	fs_thmb_viewport.width(jQuery(window).width());

    jQuery('.fs_slide_thmb').click(function () {
        goToSlide(parseInt(jQuery(this).attr('data-count')));
    });
    jQuery('.fs_slider_prev').click(function () {
        prevSlide();
    });
    jQuery('.fs_slider_next').click(function () {
        nextSlide();
    });

	jQuery(document.documentElement).keyup(function (event) {
		if ((event.keyCode == 37) || (event.keyCode == 40)) {
			prevSlide();
		// Right Arrow or Up Arrow
		} else if ((event.keyCode == 39) || (event.keyCode == 38)) {
			nextSlide();
		}	
	});
	jQuery('.fs_slide').on("swipeleft",function(){
		nextSlide();
	});
	jQuery('.fs_slide').on("swiperight",function(){
		prevSlide();
	});
	
    jQuery('#fs_play-pause').click(function () {
        if (jQuery(this).hasClass('fs_pause')) {
            fs_thmb.addClass('paused');
            jQuery(this).removeClass('fs_pause').addClass('fs_play');
            clearInterval(fs_interval);
        } else {
            fs_thmb.removeClass('paused');
            jQuery(this).removeClass('fs_play').addClass('fs_pause');
            fs_interval = setInterval('nextSlide()', fs_options.slide_time);
        }
    });

    /* N E X T   S L I D E */
    nextSlide = function () {
        clearInterval(fs_interval);
        thisSlide = parseInt(fs_container.find('.current-slide').attr('data-count'));
        fs_container.find('.slide' + thisSlide).find('iframe').remove();
        thisSlide++;
        cleanSlide = thisSlide - 2;
        nxtSlide = thisSlide + 1;
        if (thisSlide == fs_container.find('li').size()) {
            thisSlide = 0;
            cleanSlide = fs_container.find('li').size() - 3;
            nxtSlide = thisSlide + 1;
        }
        if (thisSlide == 1) {
            cleanSlide = fs_container.find('li').size() - 2;
        }
        $fs_title.fadeOut(300);
        $fs_descr.fadeOut(300, function () {
            $fs_title.html(fs_options.slides[thisSlide].title).css('color', fs_options.slides[thisSlide].titleColor);
            $fs_descr.html(fs_options.slides[thisSlide].description).css('color', fs_options.slides[thisSlide].descriptionColor);
            $fs_title.fadeIn(300);
            $fs_descr.fadeIn(300);
        });

        currentObj = fs_container.find('.slide' + thisSlide);
        nextObj = fs_container.find('.slide' + nxtSlide);
        fs_container.find('.slide' + cleanSlide).attr('style', '');
        if (currentObj.attr('data-type') == 'image') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-src') + ') no-repeat;');
        } else if (currentObj.attr('data-type') == 'youtube') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
            currentObj.append('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' + currentObj.attr('data-src') + '?controls=0&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1" frameborder="0" allowfullscreen></iframe>');
        } else {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
            currentObj.append(jQuery('<iframe width="100%" height="100%" src="http://player.vimeo.com/video/' + currentObj.attr('data-src') + '?api=1&amp;title=0&amp;byline=0&amp;portrait=0&autoplay=1&loop=0&controls=0&player_id=' + currentObj.attr('data-id') + '" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>').attr('id', currentObj.attr('data-id')));
        }

        if (nextObj.attr('data-type') == 'image') {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-src') + ') no-repeat;');
        } else if (nextObj.attr('data-type') == 'youtube') {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
        } else {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
        }
        jQuery('.current-slide').removeClass('current-slide');
        jQuery('.slide' + thisSlide).addClass('current-slide');

        if (jQuery(window).width() > 1024) {
            if (jQuery('iframe').size() > 0) {
                if (((window_h + 150) / 9) * 16 > window_w) {
                    jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
                    jQuery('iframe').css({
                        'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
                        'top': "-75px",
                        'margin-top': '0px'
                    });
                } else {
                    jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
                    jQuery('iframe').css({
                        'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
                        'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
                        'top': '50%'
                    });
                }
            }
        } else if (jQuery(window).width() < 760) {
            jQuery('iframe').height(window_h).width(window_w).css({
                'top': '0px',
                'margin-left': -1 * window_w / 2,
                'margin-top': '0px'
            });
        }
	
        /*SETUP VIDEO*/
        if (jQuery(window).width() > 1024) {
            if (jQuery('iframe').size() > 0) {
                if (((window_h + 150) / 9) * 16 > window_w) {
                    jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
                    jQuery('iframe').css({
                        'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
                        'top': "-75px",
                        'margin-top': '0px'
                    });
                } else {
                    jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
                    jQuery('iframe').css({
                        'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
                        'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
                        'top': '50%'
                    });
                }
            }
        } else if (jQuery(window).width() < 760) {
            jQuery('iframe').height(window_h).width(window_w).css({
                'top': '0px',
                'margin-left': -1 * window_w / 2,
                'margin-top': '0px'
            });
        } else {
            jQuery('iframe').height(window_h).width(window_w).css({
                'top': '0px',
                'margin-left' : '0px',
				'left' : '0px',
                'margin-top': '0px'
            });			
		}
        if (!fs_thmb.hasClass('paused') && currentObj.attr('data-type') == 'image') {
            fs_interval = setInterval('nextSlide()', fs_options.slide_time);
        }		
    }

    /* P R E V I O U S   S L I D E */
    prevSlide = function () {
        clearInterval(fs_interval);
        thisSlide = parseInt(fs_container.find('.current-slide').attr('data-count'));
        fs_container.find('.slide' + thisSlide).find('iframe').remove();
        thisSlide--;
        nxtSlide = thisSlide - 1;
        cleanSlide = thisSlide + 2;
        if (thisSlide < 0) {
            thisSlide = fs_container.find('li').size() - 1;
            cleanSlide = 1;
        }
        if (thisSlide == fs_container.find('li').size() - 2) {
            cleanSlide = 0;
        }
        $fs_title.fadeOut(300);
        $fs_descr.fadeOut(300, function () {
            $fs_title.html(fs_options.slides[thisSlide].title).css('color', fs_options.slides[thisSlide].titleColor);
            $fs_descr.html(fs_options.slides[thisSlide].description).css('color', fs_options.slides[thisSlide].descriptionColor);
            $fs_title.fadeIn(300);
            $fs_descr.fadeIn(300);
        });

        currentObj = fs_container.find('.slide' + thisSlide);
        nextObj = fs_container.find('.slide' + nxtSlide);

        fs_container.find('.slide' + cleanSlide).attr('style', '');
        if (currentObj.attr('data-type') == 'image') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-src') + ') no-repeat;');
        } else if (currentObj.attr('data-type') == 'youtube') {
            currentObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
            currentObj.append('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' + currentObj.attr('data-src') + '?controls=0&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1" frameborder="0" allowfullscreen></iframe>');
        } else {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
            currentObj.append(jQuery('<iframe width="100%" height="100%" src="http://player.vimeo.com/video/' + currentObj.attr('data-src') + '?api=1&amp;title=0&amp;byline=0&amp;portrait=0&autoplay=1&loop=0&controls=0&player_id=' + currentObj.attr('data-id') + '" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>').attr('id', currentObj.attr('data-id')));
        }

        if (nextObj.attr('data-type') == 'image') {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-src') + ') no-repeat;');
        } else if (nextObj.attr('data-type') == 'youtube') {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
        } else {
            nextObj.attr('style', 'background:url(' + nextObj.attr('data-bg') + ') no-repeat;');
        }
        jQuery('.current-slide').removeClass('current-slide');
        jQuery('.slide' + thisSlide).addClass('current-slide');

        if (jQuery(window).width() > 1024) {
            if (jQuery('iframe').size() > 0) {
                if (((window_h + 150) / 9) * 16 > window_w) {
                    jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
                    jQuery('iframe').css({
                        'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
                        'top': "-75px",
                        'margin-top': '0px'
                    });
                } else {
                    jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
                    jQuery('iframe').css({
                        'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
                        'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
                        'top': '50%'
                    });
                }
            }
        } else if (jQuery(window).width() < 760) {
            jQuery('iframe').height(window_h).width(window_w).css({
                'top': '0px',
                'margin-left': -1 * window_w / 2,
                'margin-top': '0px'
            });
        } else {
            jQuery('iframe').height(window_h).width(window_w).css({
                'top': '0px',
                'margin-left' : '0px',
				'left' : '0px',
                'margin-top': '0px'
            });			
		}

        jQuery('.current-slide').removeClass('current-slide');
        jQuery('.slide' + thisSlide).addClass('current-slide');

        if (!fs_thmb.hasClass('paused') && currentObj.attr('data-type') == 'image') {
            fs_interval = setInterval('nextSlide()', fs_options.slide_time);
        }
    }

    /* S E L E C T   S L I D E */
    goToSlide = function (set_slide) {
        clearInterval(fs_interval);
        oldSlide = parseInt(fs_container.find('.current-slide').attr('data-count'));
        thisSlide = set_slide;

        $fs_title.fadeOut(300);
        $fs_descr.fadeOut(300, function () {
            $fs_title.html(fs_options.slides[thisSlide].title).css('color', fs_options.slides[thisSlide].titleColor);
            $fs_descr.html(fs_options.slides[thisSlide].description).css('color', fs_options.slides[thisSlide].descriptionColor);
            $fs_title.fadeIn(300);
            $fs_descr.fadeIn(300);
        });

        fs_container.find('.fs_slide').attr('style', '');
        fs_container.find('.fs_slide').find('iframe').remove();
        currentObj = fs_container.find('.slide' + thisSlide);
        if (currentObj.attr('data-type') == 'image') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-src') + ') no-repeat;');
        } else if (currentObj.attr('data-type') == 'youtube') {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
			currentObj.append('<iframe width="100%" height="100%" src="http://www.youtube.com/embed/' + currentObj.attr('data-src') + '?controls=0&autoplay=1&showinfo=0&modestbranding=1&wmode=opaque&rel=0&hd=1&disablekb=1" frameborder="0" allowfullscreen></iframe>');
        } else {
            currentObj.attr('style', 'background:url(' + currentObj.attr('data-bg') + ') no-repeat;');
            currentObj.append(jQuery('<iframe width="100%" height="100%" src="http://player.vimeo.com/video/' + currentObj.attr('data-src') + '?api=1&amp;title=0&amp;byline=0&amp;portrait=0&autoplay=1&loop=0&controls=0&player_id=' + currentObj.attr('data-id') + '" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>').attr('id', currentObj.attr('data-id')));
        }

        jQuery('.current-slide').removeClass('current-slide');
        jQuery('.slide' + thisSlide).addClass('current-slide');

        if (!fs_thmb.hasClass('paused') && currentObj.attr('data-type') == 'image') {
            fs_interval = setInterval('nextSlide()', fs_options.slide_time);
        }

        /*SETUP VIDEO*/
        if (jQuery(window).width() > 1024) {
            if (jQuery('iframe').size() > 0) {
                if (((window_h + 150) / 9) * 16 > window_w) {
                    jQuery('iframe').height(window_h + 150).width(((window_h + 150) / 9) * 16);
                    jQuery('iframe').css({
                        'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
                        'top': "-75px",
                        'margin-top': '0px'
                    });
                } else {
                    jQuery('iframe').width(window_w).height(((window_w) / 16) * 9);
                    jQuery('iframe').css({
                        'margin-left': (-1 * jQuery('iframe').width() / 2) + 'px',
                        'margin-top': (-1 * jQuery('iframe').height() / 2) + 'px',
                        'top': '50%'
                    });
                }
            }
        } else if (jQuery(window).width() < 760) {
            jQuery('iframe').height(window_h).width(window_w).css({
                'top': '0px',
                'margin-left': -1 * window_w / 2,
                'margin-top': '0px'
            });
        } else {
            jQuery('iframe').height(window_h).width(window_w).css({
                'top': '0px',
                'margin-left' : '0px',
				'left' : '0px',
                'margin-top': '0px'
            });			
		}
    }

    fs_thmb_viewport.width(jQuery(window).width())
        .mouseenter(function () {
            var h = jQuery(this).width(),
                tlist = jQuery('.fs_thmb_list');
            window._s_top = parseInt(tlist.css('left'));
            window._sh = setInterval(function () {
                if (
                    (window._s_top >= 0 && window._sp > 0) ||
                        (window._s_top < 0 && window._s_top > -(tlist.width() - h)) ||
                        (window._sp < 0 && window._s_top <= -(tlist.width() - h))
                    ) {
                    var sign = (window._sp >= 0),
                        val = Math.pow(window._sp * 15, 2),
                        val = (sign) ? val : -val;
                    window._s_top -= val;
                    if (window._s_top > 0) {
                        window._s_top = 0;
                    }
                    if (window._s_top < -(tlist.width() - h)) {
                        window._s_top = -(tlist.width() - h);
                    }
                    if (jQuery('.fs_thmb_list').width() > fs_thmb_viewport.width()) {
                        tlist.stop().animate({
                            left: window._s_top
                        }, 500);
                    }
                }
            }, 100);
        }).mouseleave(function () {
            clearInterval(window._sh);
        }).mousemove(function (e) {
            y = e.pageX;
            h = jQuery(this).width(),
                p = y / h;

            if (y > (jQuery(window).width()) * 0.8) {
                window._sp = Math.round((p - 0.5) * 50) / 50;
            }
            else if (y < (jQuery(window).width()) * 0.2) {
                window._sp = Math.round((p - 0.5) * 50) / 50;
            }
            else {
                window._sp = 0
            }
        });
}

jQuery(document).ready(function ($) {
    var fs_thmb_list = jQuery('.fs_thmb_list');
    fs_thmb_list.mousedown(function () {
        fs_thmb_list.addClass('clicked');
    });
    fs_thmb_list.mouseup(function () {
        fs_thmb_list.removeClass('clicked');
    });
	jQuery('.fs_thmb_viewport').hover(function(){
		jQuery('.fs_controls').addClass('up_me');
		jQuery('.fs_title_wrapper ').addClass('up_me');
	},function(){
		jQuery('.fs_controls').removeClass('up_me');
		jQuery('.fs_title_wrapper ').removeClass('up_me');
	});
	if (jQuery('.hide_me').size() > 0) {
		jQuery('.up_me').removeClass('up_me');
	}

});
jQuery(window).resize(function () {
   	jQuery('.fs_thmb_viewport').width(jQuery(window).width());
    jQuery('.fs_thmb_list').css('left', '0px');
});
jQuery(window).load(function () {
   	jQuery('.fs_thmb_viewport').width(jQuery(window).width());
    jQuery('.fs_thmb_list').css('left', '0px');
});