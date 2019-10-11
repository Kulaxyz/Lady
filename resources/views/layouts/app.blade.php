<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">


    <!-- viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(Route::current() && Route::current()->getName() == 'live')
            <title>Lady Secrets - женский портал и форум, все секреты и советы женщин | Онлайн общение, анонимные публикации</title>
    @else
        {!! Artesaos\SEOTools\Facades\SEOTools::generate(true) !!}
    @endif

    <!-- Scripts -->
{{--    <script src="{{asset('js/app.js')}}" defer></script>--}}
{{--    <script src='{{ asset('js/add-field.js') }}'></script>--}}

<!-- Fonts -->

{{--    <link rel="stylesheet" href="{{asset('css/style.css')}}">--}}
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
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

{{--    <script defer src="{{ asset('js/all.min.js') }}"></script>--}}

    {{--    <!-- Latest compiled and minified CSS -->--}}
{{--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">--}}

{{--    --}}{{--    <!-- Latest compiled and minified JavaScript -->--}}
{{--        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>--}}

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
{{--    <link rel="stylesheet" href="{{asset('css/chosen.min.css')}}">--}}
    <link rel="stylesheet" href="{{asset('css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}">



    <link rel="stylesheet" href="{{asset('css/emojionearea.min.css')}}">
    <script src="{{ asset('js/emojionearea.min.js') }}"></script>
{{--        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>--}}


    <link href="{{asset('css/site.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{asset('css/all.css')}}">--}}

</head>
<body>
<div class="wrap-top_mobile_head">
    <div class="container">
        <div class="top_mobile_head">
            <div class="top_mobile_head-logo">
                <a href="/">
                    <img src="/img/logo.svg" alt="" class="logo_img">
                </a>
            </div>
            @auth
            <div class="top_mobile_head-publish">
                <a href="{{route('add-post')}}">
                    <div class="top_mobile_head-publish-icon">
                        <img src="/img/publish_icon.svg" alt="">
                    </div>
                    <span>Опубликовать</span>
                </a>
            </div>
            @endauth

            @guest
            <div class="top_mobile_head-publish-authorization">
                <div class="wrap-authorization">
                    <div class="sign_in authorization-el unselectable signIn_open">
                        <div class="authorization-icon authorization-icon__sign_in"></div>
                        <span>Вход</span>
                    </div>
                    <div class="registration authorization-el unselectable registration_open">
                        <div class="authorization-icon authorization-icon__registration"></div>
                        <span>Регистрация</span>
                    </div>
                </div>
            </div>
            @endguest

        </div>
    </div>
</div>

<div class="wrap-menu-window-mobile">
    <div class="container">
        <div class="menu-window-mobile-top">
            <search></search>

            @auth
                <div class="user">
                    <a href="{{route('profile', Auth::id())}}" class="user_first_a">
                        <div class="user-img" style="background-image: url(/storage/images/avatars/{{Auth::user()->avatar}});"></div>
                        <span>{{Auth::user()->name}}
                            <span>Перейти в профиль</span>
                        </span>
                    </a>
                    <a href="{{route('profile', Auth::id())}}">
                        <div class="arr_link">
                            <img src="/img/arr_user.svg" alt="">
                        </div>
                    </a>
                </div>
            @endauth
        </div>
    </div>
    <div class="menu-window-mobile-maian">
        <div class="container">
            <ul class="menu-pages">
                <li class="{{ (request()->is('*popular*')) ? 'active' : '' }}"><a href="{{route('popular')}}">
                        <div class="icon_li best"></div>
                        <span>Лучшее</span>
                    </a></li>
                <li class="{{ (request()->is('*discussed*')) ? 'active' : '' }}">
                    <a href="{{route('discussed')}}">
                        <div class="icon_li discuss"></div>
                        <span>Обсуждаемое</span>
                    </a>
                </li>
                <li class="{{ (request()->is('*favorites*')) ? 'active' : '' }}">
                    <a href="{{route('favorites')}}">
                        <div class="icon_li bookmark"></div>
                        <span>Закладки</span>
                    </a></li>
                <li class="
                                {{ ((request()->is('*tags*')) && !(request()->is('*my/tags*'))) ? 'active' : '' }}">
                    <a href="{{route('tags')}}">
                        <div class="icon_li topics"></div>
                        <span>Темы</span>
                    </a></li>
                @can('add-tag')
                    <li class="
                                    {{ (request()->is('*tag/edit*')) ? 'active' : '' }}">
                        <a href="{{ route('tag-edit') }}">
                            <div class="icon_li topics"></div>
                            <span>Тема (админ)</span>
                        </a>
                    </li>
                @endcan
                <li><a href="/pages/settings.html">
                        <div class="icon_li settings"></div>
                        <span>Настройки</span>
                    </a></li>
                <li><a onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                       href="{{ route('logout') }}">
                        <div class="icon_li exit"></div>
                        Выйти
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="container">
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
                <a href="/pages/support.html">Служба поддержки</a>
            </li>
        </ul>
    </div>
</div>

@if(session()->has('notify'))
    <div class="confirm-email">
        <div class="close close-mail"></div>
        <p>{{ session()->get('notify') }}</p>
    </div>
@endif
@auth
    @if(auth()->user()->email_verified_at == null)
        <div class="confirm-email">
            <div class="close close-mail"></div>
            <p>Пожалуйста подтвердите свой E-mail</p>
        </div>
    @endif
@endauth
<div id="wrap-content">
    <div class="container" id="app" >
        <div id="wrap-content-content">
            <div class="wrap-main-content">

            <div class="wrap-left-menu">
                <div class="left-menu-content">
                    <a class="logo" href="/">
                        <img src="/img/logo.svg" alt="" class="logo_img">
                    </a>
                    <nav class="menu">
                        <ul class="menu-pages">

                            <li @if(Route::current()) class="{{ Route::current()->getName() == 'live' ? 'active' : '' }} mobShow live" @endif><a href="{{ route('live') }}">
                                    <div class="icon_li main"></div>
                                    <span>Лента live (Главная)</span>
                                </a></li>
                            @auth
                            <li class="{{ (request()->is('*my*')) ? 'active' : '' }} mobShow tape">
                                <a href="{{ route('my-tags') }}">
                                    <div class="icon_li tape">
                                        @auth
                                            <live-notifications :user="{{ Auth::user() }}"></live-notifications>
                                        @endauth
                                    </div>
                                    <span>Моя лента</span>
                                </a>
                            </li>
                            @endauth
                            @guest
                            <li class="{{ (request()->is('*my*')) ? 'active' : '' }} mobShow tape">
                                <a href="{{ route('my-tags') }}" onclick="preventDefault() " class="signIn_open">
                                    <div class="icon_li tape">
                                    </div>
                                    <span>Моя лента</span>
                                </a>
                            </li>
                            @endguest
                            <li class="{{ (request()->is('*popular*')) ? 'active' : '' }}"><a href="{{route('popular')}}">
                                    <div class="icon_li best"></div>
                                    <span>Лучшее</span>
                                </a></li>
                            <li class="{{ (request()->is('*discussed*')) ? 'active' : '' }}">
                                <a href="{{route('discussed')}}">
                                    <div class="icon_li discuss"></div>
                                    <span>Обсуждаемое</span>
                                </a>
                            </li>
                            @auth
                            <li class=" {{ (request()->is('*notifications*')) ? 'active' : '' }} mobShow notification">
                                <a href="{{ route('notifications') }}">
                                    <div class="icon_li notification">
                                      <notifications-count :user="{{ Auth::user() }}"></notifications-count>
                                    </div>
                                    <span>Уведомления</span>
                                </a></li>
                            @endauth
                            @guest
                                <li class=" {{ (request()->is('*notifications*')) ? 'active' : '' }} mobShow notification">
                                    <a href="{{ route('notifications') }}"
                                       onclick="preventDefault()" class="signIn_open">
                                        <div class="icon_li notification">
                                        </div>
                                        <span>Уведомления</span>
                                    </a>
                                </li>
                            @endguest
                            @auth
                            <li class="mobShow messages {{ (request()->is('*chat*')) || (request()->is('*dialogs*')) ? 'active' : '' }}"><a href="{{ route('dialogs') }}">
                                    <div class="icon_li messages">

                                            <messages-count :user="{{Auth::user()}}"></messages-count>

                                    </div>
                                    <span>Сообщения</span>
                                </a></li>
                            @endauth
                            @guest
                                <li class="mobShow messages
                                    {{ (request()->is('*chat*')) || (request()->is('*dialogs*')) ? 'active' : '' }}">
                                    <a href="{{ route('dialogs') }}" onclick="preventDefault()" class="signIn_open">
                                        <div class="icon_li messages">
                                        </div>
                                        <span>Сообщения</span>
                                    </a>
                                </li>
                            @endguest
                            @auth
                                <li class="{{ (request()->is('*favorites*')) ? 'active' : '' }}">
                                    <a href="{{ route('favorites') }}">
                                        <div class="icon_li bookmark"></div>
                                        <span>Закладки</span>
                                    </a>
                                </li>
                            @endauth
                            @guest
                                <li class="{{ (request()->is('*favorites*')) ? 'active' : '' }}">
                                    <a href="{{ route('favorites') }}" onclick="preventDefault()" class="signIn_open">
                                        <div class="icon_li bookmark"></div>
                                        <span>Закладки</span>
                                    </a>
                                </li>
                            @endguest
                            <li class="
                                {{ ((request()->is('*tags*')) && !(request()->is('*my/tags*'))) ? 'active' : '' }}">
                                <a href="{{ route('tags') }}">
                                    <div class="icon_li topics"></div>
                                    <span>Темы</span>
                                </a>
                            </li>
                            @can('add-tag')
                            <li class="
                                {{ (request()->is('*tag/edit*')) ? 'active' : '' }}">
                                <a href="{{ route('tag-edit') }}">
                                    <div class="icon_li topics"></div>
                                    <span>Темы (админ)</span>
                                </a>
                            </li>
                            @endcan
                            <li class="mobMenu mobBurger">
                                <a>
                                    <div class="icon_li mobBurger"></div>
                                    <span>Меню</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    @auth
                        <div class="link_post btn-green">
                            <a href="{{ route('add-post') }}">Опубликовать</a>
                        </div>
                    @endauth
                    @guest
                        <div class="link_post btn-green">
                            <a href="{{ route('add-post') }}" onclick="preventDefault()" class="signIn_open">Опубликовать</a>
                        </div>
                    @endguest
                    <ul class="site-info site-info_desctop">
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
                            <a href="/pages/support.html">Служба поддержки</a>
                        </li>
                    </ul>

                    <p class="foot-info-site">© 2019 Женский портал. </p>
                </div>
            </div>

                <div class="main-content">

                    <div class="main-content-top">
                        <search></search>
                        @auth
                            <div class="user unselectable">
                                <div class="user-img" style="background-image: url(/storage/images/avatars/{{Auth::user()->avatar}});"></div>
                                <span>{{Auth::user()->name}}</span>
                                <div class="user-menu">
                                    <ul>
                                        <li><a href="{{ route('profile', Auth::id()) }}">
                                                <img src="/img/user.svg" alt="">
                                                <span>Мой профиль</span>
                                            </a>
                                        </li>
                                        <li><a href="/pages/settings.html">
                                                <img src="/img/settigns_icons/settings.svg" alt="">
                                                <span>Настройки</span>
                                            </a></li>
                                        <li><a onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"
                                               href="{{ route('logout') }}">
                                                <img src="/img/settigns_icons/logout.svg" alt="">
                                                <span>Выйти</span>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                                <div class="user-arrow unselectable"></div>
                            </div>
                        @endauth

                        @guest
                            <div class="wrap-authorization desctop">
                                <div class="sign_in authorization-el unselectable signIn_open">
                                    <div class="authorization-icon authorization-icon__sign_in"></div>
                                    <span>Вход</span>
                                </div>
                                <div class="registration authorization-el unselectable registration_open">
                                    <div class="authorization-icon authorization-icon__registration"></div>
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
    @if(Route::current())
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
                            <input placeholder="email" name="email" id="email" type="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                            <a href="#" class="forgotPass_open">Забыли пароль?</a>
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
                            <input name="name" type="text" placeholder="Логин">
                            <input name="email" type="text" placeholder="E-mail">
                            <input name="password" type="password" placeholder="Пароль">
                            <input name="password_confirmation" type="password" placeholder="Пароль">
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

    <div class="wrap-pop-up" id="forgot-pass">
        <div class="pop-up-body">
            <div class="pop-up-body-authorization">
                <div class="close"></div>
                <p class="infoPopUp">
                    На ваш е-майл будут отправлены дальнейшие инструкции для восстановления пароля
                </p>
                <h4>Введите E-mail</h4>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="body-authorization-top">
                        <div class="inputs">
                            <input type="email" name="email" value="{{ old('email') }}"
                                   required autocomplete="email" autofocus placeholder="E-mail">
                        </div>
                        <button type="submit">Отправить</button>
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
    <div class="wrap-pop-up" id="reset-pass"
         @if(Route::current() && Route::current()->getName() == 'password.reset') style="display:block !important;" @endif
    >
        <div class="pop-up-body">
            <div class="pop-up-body-authorization">
                <div class="close"></div>
{{--                <p class="infoPopUp">--}}
{{--                    Введите ваш email и новый пароль--}}
{{--                </p>--}}
                <h4>Введите ваш email и новый пароль</h4>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @if(Route::current() && Route::current()->getName() == 'password.reset')
                        <input type="hidden" name="token" value="{{ $token }}">
                    @endif
                    <div class="body-authorization-top">
                        <div class="inputs">
                            <input type="email" name="email" value="{{ old('email') }}"
                                   required autocomplete="email" autofocus placeholder="E-mail">
                            <input name="password" type="password" placeholder="Пароль">
                            <input name="password_confirmation" type="password" placeholder="Пароль ещё раз">

                        </div>
                        @error('password')--}}
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                        <button type="submit">Отправить</button>
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

    @endif
@endguest

@yield('scripts')

<script src="/js/select2.min.js"></script>
<script src="/js/slick.min.js"></script>
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
                    window.location.reload(true);
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
            var formData = registerForm.serialize();
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

                },
                success: function (data) {
                    window.location.reload(true);
                }
            });
        });

    });
</script>
</body>
</html>
