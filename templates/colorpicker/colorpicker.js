jQuery(function() {
	/* Add a new stylesheet */
    var stylesheet = $("link[href*='schemes'], link[href*='theme']");
	var prefix = 'assets/css';
	if($.cookie("anps_move_scheme")) {
		$('.colorpicker .colors li').removeClass('selected').eq($.cookie("anps_move_scheme")).addClass("selected");
		stylesheet.attr('href', prefix + '/scheme-' + $.cookie("anps_move_scheme") + '.css');
	}
	/* User clicks on a color scheme */
    $('.colorpicker .colors button').on('click', function() {
        $('.colorpicker').removeClass('animate');
    	var parent = $(this).parent();
        $('.colorpicker .colors li').removeClass('selected');
        $.cookie("anps_move_scheme", parent.index(), { path: '/' });
        parent.addClass('selected');
        stylesheet.attr('href', prefix + '/scheme-' + parent.index() + '.css');
    });
    /* User clicks on a pattern */
    if($.cookie("anps_pattern")) {
        $('.colorpicker .patterns li').removeClass('selected').eq($.cookie("anps_pattern")-1).addClass("selected");
        $('body').addClass('pattern-' + $.cookie("anps_pattern"));
    }
    $('.colorpicker .patterns button').on('click', function() {
        $('body').removeClass('pattern-1 pattern-2 pattern-3 pattern-4 pattern-5 pattern-6 pattern-7 pattern-8 pattern-9 pattern-10');
        $('.colorpicker').removeClass('animate');
        var parent = $(this).parent();
        $('.colorpicker .patterns li').removeClass('selected');
        $.cookie("anps_pattern", parent.index() + 1, { path: '/' });
        parent.addClass('selected');
         $('body').addClass('pattern-' + (parent.index() + 1));
    });
    /* User hides the colorpicker */
    $('.colorpicker .close button').on('click', function() {
        $('.colorpicker').removeClass('animate');
        $('.colorpicker').toggleClass('close');
        var cookieVal = 'false';
        if( $('.colorpicker').hasClass('close') ) {
        	cookieVal = 'true';
    	}
    	$.cookie("anps_move_closed", cookieVal, { path: '/' });
    });
    /* Close colorpicker if user has previously had it closed */
	if( $.cookie("anps_move_closed") != 'true' ) {
		$('.colorpicker').removeClass('close');
	}

    /* Layout */

    $(".layout").on("change", function() {
        $("body").removeClass("boxed");

        var el = $("body");
        if($(this).val() == 'boxed') {
            el.addClass("boxed");
            $.cookie("anps_boxed", $(this).val(), { path: '/' });
        } else {
            el.removeClass("boxed");
            $.cookie("anps_boxed", $(this).val(), { path: '/' });
        }
    });

    if($.cookie("anps_boxed")) {
        var el = $("body");
        $('.layout').val($.cookie("anps_boxed"));
        if($.cookie("anps_boxed") == 'boxed') {
            el.addClass("boxed");
        } else {
            el.removeClass("boxed");
        }
    }

    /* Menu style */

    $(".menu-style").on("change", function() {
        $(".site-header").removeClass("sticky");

        var el = $(".site-header");
        if($(this).val() == 'sticky') {
            el.addClass("sticky");
            $.cookie("anps_menu_style", $(this).val(), { path: '/' });
        } else {
            el.removeClass("sticky");
            $.cookie("anps_menu_style", $(this).val(), { path: '/' });
        }
    });

    if($.cookie("anps_boxed")) {
        var el = $(".site-header");
        $(".menu-style").val($.cookie("anps_menu_style"));
        if($.cookie("anps_menu_style") == 'sticky') {
            el.addClass("sticky");
        } else {
            el.removeClass("sticky");
        }
    }
});