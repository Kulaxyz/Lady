/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');

import Vuetify from "vuetify";

Vue.use(Vuetify);
import moment from 'moment';
import 'moment-timezone';

// ...
moment.locale('RU');

Vue.prototype.$moment = moment;

import 'vuetify/dist/vuetify.min.css'
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const VueUploadComponent = require('vue-upload-component')
Vue.component('file-upload', VueUploadComponent)


Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('add-field', require('./components/AddField.vue').default);
Vue.component('chat', require('./components/PrivateChat.vue').default);
Vue.component('notifications-count', require('./components/notificationsCount.vue').default);
Vue.component('live-notifications', require('./components/liveNotifications.vue').default);
Vue.component('search', require('./components/Searchbar').default);
Vue.component('posts', require('./components/Posts').default);
Vue.component('votes', require('./components/Votes').default);
Vue.component('img-upload', require('./components/imgUpload').default);
Vue.component('activities', require('./components/Activities').default);
Vue.component('comment-activities', require('./components/comment-activities').default);
Vue.component('dialogs', require('./components/Dialogs').default);
Vue.component('messages-count', require('./components/MessagesCount').default);




/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

window.onload = function () {
    const app = new Vue({
        el: '#app',
    });
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


            function initTexarea(block) {
                $(block).emojioneArea({
                    search: false,
                    filters: {
                        recent: {
                            title: 'Часто используемые'
                        },
                        smileys_people: {
                            title: 'Эмоции и жесты'
                        },
                        animals_nature: {
                            title: 'Животные и растения'
                        },
                        food_drink: {
                            title: 'Еда'
                        },
                        activity: {
                            title: 'Спорт и активности'
                        },
                        travel_places: {
                            title: 'Путешествия и транспорт'
                        },
                        objects: {
                            title: 'Предметы'
                        },
                        symbols: {
                            title: 'Символы'
                        },
                        flags: {
                            title: 'Флаги'
                        },
                    }
                });
            }
            initTexarea($('.textarea-block__textarea'));

            $('.select_jq').select2({
                // no_results_text: 'Нет таких результатов',
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

            $('.forgotPass_open').on('click', function() {
                openPopUp($('#forgot-pass'));
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

            $('.user').on('click', function() {
                let wrap_all = $(this);
                if ( wrap_all.hasClass('open') ) {
                    wrap_all.removeClass('open');
                    closeUserMenu();
                }else{
                    wrap_all.addClass('open');
                    wrap_all.find('.user-menu').fadeIn(200);
                }
            });

            function closeUserMenu() {
                $('.user').removeClass('open');
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

            $('#messages-content-body').scrollTop(100000);

            if ( $(window).width() <= 1000 ) {
                // $('body').scrollTop($('body').outerHeight());
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

            // $('form.form-settigns-el').on('submit', function(e) {
            //     e.preventDefault();
            //     closeSettignsEl($(this).closest('.settings-content-el'));
            //     return false;
            // });

            if ( $(window).width() > 600 ) {
                // var el = $('.textarea-block__textarea').emojioneArea({
                // 	search: false,
                // });
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


            $('.close-mail').click(function() {
                $('.confirm-email').fadeOut(100);
            });



            $(document).on('click', '.reply-comment-btn', function() {
                $('.reply-comment-btn').removeClass('btn-form');
                $(this).addClass('btn-form');
                var wrap_all = $(this).closest('.comment-reply');
                var textarea_block = wrap_all.find('.textarea-block');
                if ( wrap_all.hasClass('init') ) {
                    if ( wrap_all.hasClass('active') ) {
                        // wrap_all.removeClass('active');
                        // $('.comment-reply').find('.textarea-block').fadeOut(300);
                    }else{
                        $('.content-comments').find('.textarea-block').fadeOut(300);
                        $('.content-comments').find('.comment-reply').removeClass('active');
                        wrap_all.addClass('active');
                        textarea_block.fadeIn(300);
                    }
                }else{
                    $('.content-comments').find('.textarea-block').fadeOut(300);
                    $('.content-comments').find('.comment-reply').removeClass('active');

                    wrap_all.addClass('init');
                    wrap_all.addClass('active');
                    var inner_block = '\
			<div class="textarea-block">\
				<textarea name="message" class="textarea-block__textarea" data-emojiable="true" placeholder="Напишите сообщение"></textarea>\
				<div class="textarea-block-media">\
					<div class="textarea-block-media_el">\
						<div class="load_media">\
							<label class="unselectable">\
								<input type="file">\
								<img src="/img/camera.svg" alt="">\
							</label>\
						</div>\
					</div>\
				</div>\
			</div>';
                    wrap_all.prepend(inner_block);
                    initTexarea(wrap_all.find('.textarea-block__textarea'));
                    wrap_all.find('.textarea-block').fadeIn(300);
                }
                return false;
            });
            $(document).on('click', '.btn-form', function() {
                let id = $(this)[0].dataset.id;
                $('#form-' + id).submit();
            });

        });

};


