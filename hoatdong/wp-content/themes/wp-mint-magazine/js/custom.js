jQuery(function ($) {
    
    var $site_navigation = $('#site-navigation');
    var offset_top = 88;
    if ($("body").hasClass("header_style_2")) {
        offset_top = 0;
    }
    if ($("body.admin-bar").hasClass("header_style_2")) {
        offset_top = 46;
    }

    $site_navigation.affix({
        offset: {
            top: offset_top
        }
    }).on('affixed.bs.affix', function () {
        $('body').addClass('sw-navbar-fixed-top');
    }).on('affixed-top.bs.affix', function () {
        $('body').removeClass('sw-navbar-fixed-top');
    });
    if ($("#site-navigation").hasClass("affix")) {
        $('body').addClass('sw-navbar-fixed-top');
    }

    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({scrollTop: 0}, 800);
        return false;
    });

    var resize_post_wrap = function () {

        $(".pd_grid_small").css('height', 'auto');
        $(".pd_grid_type_post").css('height', 'auto');
        if ($(window).width() >= 768) {
            var max_height = $('.pd_grid_type_wrap').find('.pd_grid_big').height();
            $('.pd_grid_type_wrap').find('.pd_grid_type_post').height(max_height);
        } else {
            var maxheight = 0;
            $('.pd_grid_type_wrap').each(function () {
                $(".pd_grid_small").children().each(function () {
                    maxheight = ($(this).height() > maxheight ? $(this).height() : maxheight);
                });
                $(".pd_grid_small").height(maxheight);
                maxheight = 0;
            });
        }

        $(".pd_featured_items").css('height', 'auto');

        if ($(window).width() >= 392) {
            var maxheight = 0;
            $('.pd_featured_post_wrop').each(function () {
                $(".pd_featured_items").children().each(function () {
                    maxheight = ($(this).height() > maxheight ? $(this).height() : maxheight);
                });
                $(".pd_featured_items").height(maxheight);
                maxheight = 0;
            });
        }
    };

    $(window).on('resize', function () {
        resize_post_wrap();
    });

    $(window).on('load', function () {
        resize_post_wrap();
    });




    $('[data-toggle="tooltip"]').tooltip();

    $('.sub-menu').addClass('dropdown-menu');
    $('.menu-item-has-children').addClass('dropdown');
    $('.toggle_nav_links .menu-item-has-children').addClass('mobile-dropdown');

    /*  $(window).resize(function() {
     if ($(window).width() < 768) {
     $(".dropdown-toggle").attr('data-toggle', 'dropdown');
     } else {
     $(".dropdown-toggle").removeAttr('data-toggle dropdown');
     }
     }); */
    $('.menu-item-has-children').children(".sub-menu").before("<span class='sub-m-menu-sign'><i class='fa fa-angle-right'></i></span>");

    //Navigation Mobile Menu
    $(".btn-mob-menu").click(function () {
        $(this).toggleClass("open");
        $("body").toggleClass("show-menu");
    });

    $(".close-mob-menu").click(function () {
        $(".btn-mob-menu").toggleClass("open");
        $("body").toggleClass("show-menu");
    });

    $(".sidebar-nav-overlay").click(function () {
        $(".btn-mob-menu").removeClass("open");
        $("body").removeClass("show-menu");
    });

    $(".mobile-dropdown > span").click(function () {
        var $cont = $(this).parent(".mobile-dropdown");
        var has_opend_this = $cont.hasClass('open');
        //console.log(has_opend_this);
        //$cont.removeClass("open");
        //$cont.children("ul.sub-menu").slideUp();

        if (!has_opend_this) {
            $cont.addClass("open");
            $cont.children("ul.sub-menu").slideDown();
        } else {
            $cont.removeClass("open");
            $cont.children("ul.sub-menu").slideUp();
        }

    });


    $('a[href="#toggle-search"]').on('click', function (event) {
        event.preventDefault();
        $('.navbar-pd-mag .bootsnipp-search .input-group > input').val('');
        $('.navbar-pd-mag .bootsnipp-search').toggleClass('open');
        $('a[href="#toggle-search"]').closest('li').toggleClass('active');

        if ($('.navbar-pd-mag .bootsnipp-search').hasClass('open')) {
            /* I think .focus dosen't like css animations, set timeout to make sure input gets focus */
            setTimeout(function () {
                $('.navbar-pd-mag .bootsnipp-search .form-control').focus();
            }, 100);
        }
    });

    $(document).on('keyup', function (event) {
        if (event.which == 27 && $('.navbar-pd-mag .bootsnipp-search').hasClass('open')) {
            $('a[href="#toggle-search"]').trigger('click');
        }
    });


});

/**
 * File skip-link-focus-fix.js.
 *
 * Helps with accessibility for keyboard only users.
 *
 * Learn more: https://git.io/vWdr2
 */
(function () {
    var isIe = /(trident|msie)/i.test(navigator.userAgent);

    if (isIe && document.getElementById && window.addEventListener) {
        window.addEventListener('hashchange', function () {
            var id = location.hash.substring(1),
                    element;

            if (!(/^[A-z0-9_-]+$/.test(id))) {
                return;
            }

            element = document.getElementById(id);

            if (element) {
                if (!(/^(?:a|select|input|button|textarea)$/i.test(element.tagName))) {
                    element.tabIndex = -1;
                }

                element.focus();
            }
        }, false);
    }
})();
