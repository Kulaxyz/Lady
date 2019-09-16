// window.Pusher = require('pusher-js');
// import Echo from "laravel-echo";
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key',
//     cluster: 'eu',
//     encrypted: true
// });


$(document).ready(function() {

    $('.select_jq').chosen({
        no_results_text: 'Нет таких результатов',
    });

    function closePopUp(wrap) {
        wrap.fadeOut(400);
        $('body').removeClass('noscroll');
        return false;
    }

    function openPopUp(wrap) {
        $('.wrap-pop-up').fadeOut(100);
        $(wrap).fadeIn(300);
        $('body').addClass('noscroll');
        return false;
    }

    $('.registration_open').on('click', function() {
        openPopUp($('#registration'));
        return false;
    });

    $('.signIn_open').on('click', function() {
        openPopUp($('#sign_in'));
        return false;
    });

    $('.wrap-pop-up .close').on('click', function() {
        closePopUp($(this).closest('.wrap-pop-up'));
    });

    jQuery(function($){
        $('.wrap-pop-up').mouseup(function (e){
            var div = $('.pop-up-body');
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                closePopUp($('.wrap-pop-up'));
                return false;
            }
        });
    });

    $(document).on('input','.inp_maxlength', function() {
        var wrap = $(this).closest('.input-el');
        var maxlength = $(this).attr('maxlength');
        var val = $(this).val().length;
        wrap.find('.count_limit').text( maxlength - val );
    });

    $('.images').slick({ // это изначально slick слайдер для основного блока изображений
        slidesToShow: 1,  // по одному слайдеру
        slidesToScroll: 1, // по одному менять
        arrows:true, // включение стрелок (если не нужны false)
        asNavFor: '.imagesnew_dotted',
        nextArrow: '<div class="slick-next"></div>',
        prevArrow: '<div class="slick-prev"></div>',
        infinite: false,
    });

    $('.imagesnew_dotted').slick({ // настройка навигации
        slidesToShow: 4, // указываем что нужно показывать 3 навигационных изображения
        asNavFor: '.images', // указываем что это навигация для блока выше
        focusOnSelect: true,
        arrows: false,
        swipe: false,
        infinite: false,
    });

    $('.mobMenu a').click(function() {
        return false;
    });

    $('.mobBurger a').on('click', function() {
        if ( $('.wrap-menu-window-mobile').hasClass('active') ) {
            $('.wrap-menu-window-mobile').removeClass('active');
            $('body').removeClass('noscroll');
        }else{
            $('.wrap-menu-window-mobile').addClass('active');
            $('body').addClass('noscroll');
        }
        return false;
    });

// $('.inp_comment').emojiarea({button: '.emoji'});

    $('.main-content-top .user').on('click', function() {
        if ( $('.user-menu').hasClass('open') ) {
            $('.user-menu').removeClass('open');
            closeUserMenu();
        }else{
            $('.user-menu').addClass('open');
            $('.user-menu').fadeIn(200);
        }
    });

    function closeUserMenu() {
        $('.user-menu').removeClass('open');
        $('.user-menu').fadeOut(200);
    }

    jQuery(function($){
        $('html,body').mouseup(function (e){
            var div = $('.main-content-top .user');
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                closeUserMenu();
                return false;
            }
        });
    });


    $('#messages-content-body').scrollTop($('#messages-content-body').outerHeight());

    if ( $(window).width() <= 1000 ) {
        $('body').scrollTop($('body').outerHeight());
    }

    $('.settings-content-el-top').on('click', function() {
        var wrap = $(this).closest('.settings-content-el');
        if ( wrap.hasClass('active') ) {
            closeSettignsEl(wrap);
        }else{
            wrap.addClass('active');
            wrap.find('.settings-content-el-body').slideDown(250);
        }
    });

    function closeSettignsEl(wrap) {
        wrap.removeClass('active');
        wrap.find('.settings-content-el-body').slideUp(250);
    }

    $('form.form-settigns-el').on('submit', function(e) {
        e.preventDefault();
        closeSettignsEl($(this).closest('.settings-content-el'));
        return false;
    });

    if ( $(window).width() > 600 ) {
        var el = $('.inp_comment').emojioneArea({
            search: false,
        });
        $('.inp_comment').click(function(){
            $(this).focus();
        });

    }

    function closeSearchResults() {
        $('.search-results').fadeOut(100);
    }

    jQuery(function($){
        $('html,body').mouseup(function (e){
            var div = $('.search');
            if (!div.is(e.target)
                && div.has(e.target).length === 0) {
                closeSearchResults();
                return false;
            }
        });
    });

});
