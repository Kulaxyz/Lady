<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
{{--    <script src="{{asset('js/app.js')}}" defer></script>--}}
{{--    <script src='{{ asset('js/add-field.js') }}'></script>--}}

<!-- Fonts -->

    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/follow.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/load-more.js')}}"></script>

{{--    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>--}}

{{--    <script src='{{ asset('js/add-field.js') }}'></script>--}}

<!-- Styles -->
    {{--    <link href="{{asset('css/app.css')}}" rel="stylesheet">--}}
    {{--    <link href="{{asset('css/all.css')}}" rel="stylesheet">--}}
    {{--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">--}}
    {{--    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>--}}
    {{--    <link rel="stylesheet"--}}
    {{--          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">--}}

    <script src="{{ asset('js/all.js') }}"></script>

    {{--    <!-- Latest compiled and minified CSS -->--}}
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    {{--    <!-- Latest compiled and minified JavaScript -->--}}
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    {{--    <!-- Latest compiled and minified CSS -->--}}
    {{--    <link rel="stylesheet"--}}
    {{--          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">--}}

    {{--    <!-- Latest compiled and minified JavaScript -->--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-ru_RU.js"></script>--}}

    {{--    @auth--}}
    {{--        <script>--}}

    {{--            --}}{{--window.Laravel.userId = '{{Auth::id()}}';--}}
    {{--        </script>--}}
    {{--    @auth--}}


    <link rel="stylesheet" href="{{asset('css/fonts.css')}}">
    <link rel="stylesheet" href="{{asset('css/chosen.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">


    <link rel="stylesheet" href="{{asset('css/emojionearea.min.css')}}">
    <script src="{{ asset('js/emojionearea.min.js') }}"></script>
    {{--    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>--}}


    <link href="{{asset('css/site.css')}}" rel="stylesheet">
</head>
<body>

<div class="wrap-top_mobile_head">
    <div class="container">
        <div class="top_mobile_head">
            <div class="top_mobile_head-logo">
                <a href="/">
                    <img src="/img/logo.png" alt="">
                </a>
            </div>
            <div class="top_mobile_head-publish">
                <a href="/pages/publication.html">
                    <div class="top_mobile_head-publish-icon">
                        <img src="/img/publish_icon.png" alt="">
                    </div>
                    <span>Опубликовать</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="wrap-menu-window-mobile">
    <div class="container">
        <div class="menu-window-mobile-top">
            <div class="search">
                <input type="text" placeholder="Поиск по сайту..">
                <div class="search-btn" style="background-image: url('/img/search.png');"></div>
            </div>
            @guest
                <div class="wrap-authorization desctop">
                    <div class="sign_in authorization-el unselectable signIn_open">
                        <img src="/img/authorization/sign_in.png" alt="">
                        <span>Вход</span>
                    </div>
                    <div class="registration authorization-el unselectable registration_open">
                        <img src="/img/authorization/registration.png" alt="">
                        <span>Регистрация</span>
                    </div>
                </div>
            @endguest

            @auth
                <div class="user">
                    <a href="{{route('profile', Auth::id())}}" class="user_first_a">
                        <img class="user-img" src="/storage/images/avatars/{{Auth::user()->avatar}}">
                        <span>{{Auth::user()->name}}
                            <span>Перейти в профиль</span>
                        </span>
                    </a>
                    <a href="/profile/my-profile.html">
                        <div class="arr_link">
                            <img src="/img/arr_profile_mobile.png" alt="">
                        </div>
                    </a>
                </div>
            @endauth
        </div>
    </div>
    <div class="menu-window-mobile-maian">
        <div class="container">
            <ul>
                <li><a href="/pages/better.html">
                        <div class="icon_li" style="background-image: url('/img/icons_li/best.png') "></div>
                        <span>Лучшее</span>
                    </a></li>
                <li><a href="/pages/discuss.html">
                        <div class="icon_li" style="background-image: url('/img/icons_li/discuss.png') "></div>
                        <span>Обсуждаемое</span>
                    </a></li>
                <li><a href="/pages/bookmark.html">
                        <div class="icon_li" style="background-image: url('/img/icons_li/bookmark.png') "></div>
                        <span>Закладки</span>
                    </a></li>
                <li><a href="/pages/topic.html">
                        <div class="icon_li" style="background-image: url('/img/icons_li/topics.png') "></div>
                        <span>Темы</span>
                    </a></li>
            </ul>
        </div>
    </div>
</div>

<div id="wrap-content">
    <div class="container" id="app" >
        <div id="wrap-content-content">
            <div class="wrap-left-menu">
                <div class="left-menu-content">
                    <a class="logo" href="/">
                        <img src="/img/logo.png" alt="">
                    </a>
                    <nav class="menu">
                        <ul>
                            <li class="{{ (request()->is('*/live')) ? 'active' : '' }} mobShow live"><a href="{{ route('list', 'live') }}">
                                    <div class="icon_li" style="background-image: url('/img/icons_li/main.png') "></div>
                                    <span>Лента live (Главная)</span>
                                </a></li>
                            <li class="{{ (request()->is('*my*')) ? 'active' : '' }} mobShow tape"><a href="{{ route('my-tags') }}">
                                    <div class="icon_li" style="background-image: url('/img/icons_li/tape.png') ">
                                        @auth
                                            <live-notifications :user="{{ Auth::user() }}"></live-notifications>
                                        @endauth
                                    </div>
                                    <span>Моя лента</span>
                                </a></li>
                            <li class="{{ (request()->is('*/popular*')) ? 'active' : '' }}"><a href="{{route('list', 'popular')}}">
                                    <div class="icon_li" style="background-image: url('/img/icons_li/best.png') "></div>
                                    <span>Лучшее</span>
                                </a></li>
                            <li class="{{ (request()->is('*/discussed*')) ? 'active' : '' }}"><a href="{{route('list', 'discussed')}}">
                                    <div class="icon_li" style="background-image: url('/img/icons_li/discuss.png') "></div>
                                    <span>Обсуждаемое</span>
                                </a></li>
                            @auth
                            <li class=" {{ (request()->is('*notifications*')) ? 'active' : '' }} mobShow notification"><a href="{{ route('notifications') }}">
                                    <div class="icon_li" style="background-image: url('/img/icons_li/notification.png') ">
                                        <notifications-count :user="{{ Auth::user() }}"></notifications-count>
                                    </div>
                                    <span>Уведомления</span>
                                </a></li>
                            @endauth
                            <li class="mobShow messages {{ (request()->is('*/chat*')) || (request()->is('*/dialogs*')) ? 'active' : '' }}"><a href="{{ route('dialogs') }}">
                                    <div class="icon_li" style="background-image: url('/img/icons_li/messages.png') ">
                                        <div class="count_activity">
                                            <span>10</span>
                                        </div>
                                    </div>
                                    <span>Сообщения</span>
                                </a></li>
                            <li class="{{ (request()->is('*favorites*')) ? 'active' : '' }}"><a href="{{ route('favorites') }}">
                                    <div class="icon_li" style="background-image: url('/img/icons_li/bookmark.png') "></div>
                                    <span>Закладки</span>
                                </a></li>
                            <li class="{{ ((request()->is('*tags*')) && !(request()->is('*my/tags*'))) ? 'active' : '' }}"><a href="{{ route('tags') }}">
                                    <div class="icon_li" style="background-image: url('/img/icons_li/topics.png') "></div>
                                    <span>Темы</span>
                                </a></li>
                            <li class="mobMenu mobBurger">
                                <a href="#">
                                    <div class="icon_li" style="background-image: url(/img/icons_li/mobBurger.png);"></div>
                                    <span>Меню</span>
                                </a>
                            </li>
                        </ul>
                    </nav>                    <div class="link_post btn-green">
                        <a href="{{ route('add-post') }}">Опубликовать</a>
                    </div>
                    <ul class="site-info">
                        <li>
                            <a href="#">Условия</a>
                        </li>
                        <li>
                            <a href="#">Политика конфиденциальности</a>
                        </li>
                        <li>
                            <a href="#">Файлы cookie</a>
                        </li>
                        <li>
                            <a href="#">Информация о рекламе</a>
                        </li>
                        <li class="else">
                            <a href="#">Еще <img src="/img/arrow-else.png" alt=""></a>
                        </li>
                    </ul>
                    <p class="foot-info-site">© 2019 Женский портал. </p>
                </div>
            </div>

            <div class="wrap-main-content">
                <div class="main-content">

                    <div class="main-content-top">
                        <search></search>
                        @auth
                            <div class="user unselectable">
                                <img class="user-img" src="/storage/images/avatars/{{Auth::user()->avatar}}">
                                <span>{{Auth::user()->name}}</span>
                                <div class="user-menu">
                                    <ul>
                                        <li><a href="{{ route('profile', Auth::id()) }}">Мой профиль</a></li>
                                        <li><a href="/pages/settings.html">Настройки</a></li>
                                        <li><a href="/pages/support.html">Служба поддержки</a></li>
                                        <li><a onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                               href="{{ route('logout') }}">Выйти
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                            </div>
                        @endauth

                        @guest
                            <div class="wrap-authorization desctop">
                                <div class="sign_in authorization-el unselectable signIn_open">
                                    <img src="/img/authorization/sign_in.png" alt="">
                                    <span>Вход</span>
                                </div>
                                <div class="registration authorization-el unselectable registration_open">
                                    <img src="/img/authorization/registration.png" alt="">
                                    <span>Регистрация</span>
                                </div>
                            </div>
                        @endguest


                    </div>

                    <section class="sec-tape" >
                        @yield('content')
                    </section>
                </div>
            </div>
        </div>
        </div>
    </div>

@guest
    <!-- PopUps start -->

    <div class="wrap-pop-up" id="sign_in">
        <div class="pop-up-body">
            <div class="pop-up-body-authorization">
                <div class="close"></div>
                <h4>Авторизация</h4>
                <div class="bg-danger error" id="loginfailedFull">
                    <i class="fa fa-times" aria-hidden="true"></i> Неправильно введены логин или пароль!
                </div>

                <form id="formLogin" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="body-authorization-top">
                        <div class="inputs">
                            <input placeholder="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror



                            <input placeholder="Пароль" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="forgot">
                            <a href="#">Забыли пароль?</a>
                        </div>
                        <button type="submit">Войти</button>
                        <div class="auth_btn registration_open">
                            <a href="#">Регистрация</a>
                        </div>
                    </div>
                    <div class="body-authorization-foot">
                        <p>или</p>
                        <div class="wrap-socials">
                            <div class="social-el">
                                <a href="#">
                                    <img src="/img/socials/twitter.png" alt="">
                                </a>
                            </div>
                            <div class="social-el">
                                <a href="#">
                                    <img src="/img/socials/vk.png" alt="">
                                </a>
                            </div>
                            <div class="social-el">
                                <a href="#">
                                    <img src="/img/socials/facebook.png" alt="">
                                </a>
                            </div>
                            <div class="social-el">
                                <a href="#">
                                    <img src="/img/socials/googleplus.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="wrap-pop-up" id="registration">
        <div class="pop-up-body">
            <div class="pop-up-body-authorization">
                <div class="close"></div>
                <h4>Регистрация</h4>

                <div class="bg-danger error" id="registerfailedFull">
                    <i class="fa fa-times" aria-hidden="true"></i> Исправьте следующие ошибки:
                </div>

                <form id="formRegister">
                    <div class="body-authorization-top">
                        <div class="inputs">
                            <input type="text" placeholder="Логин">
                            <input type="text" placeholder="E-mail">
                            <input type="password" placeholder="Пароль">
                        </div>
                        <div class="wrap-checkbox unselectable">
                            <label>
                                <div class="checkbox-el">
                                    <input type="checkbox" required="">
                                    <div class="checkbox"></div>
                                </div>
                                <span>Создавая аккаунт, я соглашаюсь с правилами сервиса<br> и даю согласие на обработку персональных данных</span>
                            </label>
                        </div>
                        <button type="submit">Создать аккаунт</button>
                        <div class="auth_btn signIn_open">
                            <a href="#">Авторизация</a>
                        </div>
                    </div>
                    <div class="body-authorization-foot">
                        <p>или</p>
                        <div class="wrap-socials">
                            <div class="social-el">
                                <a href="#">
                                    <img src="/img/socials/twitter.png" alt="">
                                </a>
                            </div>
                            <div class="social-el">
                                <a href="#">
                                    <img src="/img/socials/vk.png" alt="">
                                </a>
                            </div>
                            <div class="social-el">
                                <a href="#">
                                    <img src="/img/socials/facebook.png" alt="">
                                </a>
                            </div>
                            <div class="social-el">
                                <a href="#">
                                    <img src="/img/socials/googleplus.png" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endguest

@yield('scripts')

<script src="/js/chosen.jquery.min.js"></script>
<script src="/js/slick.min.js"></script>
{{--<script src="/js/main.js"></script>--}}
<script>
    $(document).ready(function() {
        $("#registerfailedFull").slideUp();
        $('#loginfailedFull').slideUp();

        var loginForm = $("#formLogin");
        var registerForm = $("#formRegister");
        let loginHtml = $('#formLogin').html();
        let registerHtml = $('#formRegister').html();
        loginForm.submit(function (e) {
            e.preventDefault();
            var formData = loginForm.serialize();
            $.ajax({
                url: '{{ url("login") }}',
                type: 'POST',
                data: formData,
                {{-- Send CSRF Token over ajax --}}
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {
                    $("#loginfailedFull").slideUp();

                    $("#formLogin").html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
                    $("#formLogin").prop("disabled", true);
                },
                success: function (data) {
                    window.location.href = data;
                },
                error: function (data) {
                    console.log(loginHtml);
                    $("#loginfailedFull").slideDown();
                    $("#formLogin").prop("disabled", false);
                    $('#formLogin').html(loginHtml);
                }
            });
        });

        registerForm.submit(function (e) {
            e.preventDefault();
            var formData = loginForm.serialize();
            $.ajax({
                url: '{{ url("register") }}',
                type: 'POST',
                data: formData,
                {{-- Send CSRF Token over ajax --}}
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                beforeSend: function () {

                    $("#formRegister").html('<i class="fa fa-spinner fa-spin fa-fw"></i>');
                    $("#formRegister").prop("disabled", true);
                },
                success: function (data) {
                    window.location.href = data;
                },
                error: function (data) {
                    $("#registerfailedFull").append('<ul>');
                    let obj = jQuery.parseJSON( data.responseText );
                    let values = Object.values(obj.errors);

                    for (value of values) {
                        $("#registerfailedFull").append('<li>' + value[0] + '</li>');
                    }

                    $("#registerfailedFull").slideDown();
                    $("#formRegister").prop("disabled", false);
                    $('#formRegister').html(registerHtml);
                    $("#registerfailedFull").append('</ul>');

                }
            });
        });

    });
</script>
</body>
</html>
