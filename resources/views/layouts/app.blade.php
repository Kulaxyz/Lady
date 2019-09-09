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
    <script src="{{asset('js/app.js')}}" defer></script>

    <!-- Styles -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    {{--    <link href="{{asset('css/all.css')}}" rel="stylesheet">--}}
{{--    <script src='{{ asset('js/add-field.js') }}'></script>--}}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.css">
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
    <script src="{{ asset('js/all.js') }}"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-ru_RU.js"></script>
    <script src="{{ asset('js/follow.js') }}"></script>

    @if(!auth()->guest())
        <script>

            {{--window.Laravel.userId = '{{Auth::id()}}';--}}
        </script>
    @endif


    <link href="{{asset('css/site.css')}}" rel="stylesheet">
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <!-- Modal -->
        @can('add-tag')
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Добавить тег</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-group" method="POST" action="{{ route('tag-add') }}">
                            <div class="modal-body">
                                    @csrf
                                    <input class="form-control" name="name" type="text">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        @endcan
        {{--End of modal--}}
        <div class="row">
            <div class="col col-3 col-md-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('list', 'live')}}">Live-лента</a>
                    </li>
                   @auth <live-notifications :user="{{auth()->user()}}"></live-notifications> @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list', 'popular') }}">Лучшее</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('tags') }}">Теги</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('list', 'discussed') }}">Обсуждаемое</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('favorites') }}">Избранное</a>
                    </li>
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('notifications') }}">Уведомления
                            <notifications-count  :user="{{auth()->user()}}"></notifications-count>
                        </a>
                    </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true"></a>
                    </li>
                    @can('add-tag')
                        <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                Добавить тег
                            </button>
                        </li>
                    @endcan

                    <a href="{{ route('add-post') }}" class="btn btn-primary btn-lg">Опубликовать</a>
                </ul>
            </div>
            <div class="nav-top col-md-9 col-9">
            {{--                            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
            {{--                                <div class="container">--}}
            {{--                                    <a class="navbar-brand" href="{{ url('/') }}">--}}
            {{--                                        {{ config('app.name', 'Laravel') }}--}}
            {{--                                    </a>--}}
            {{--                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
            {{--                                        <span class="navbar-toggler-icon"></span>--}}
            {{--                                    </button>--}}

            {{--                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
            {{--                                        <!-- Left Side Of Navbar -->--}}
            {{--                                        <ul class="navbar-nav mr-auto">--}}
            {{--                                            <li class="nav-item">--}}
            {{--                                                <a href="{{ route('add-post') }}">Добавить пост</a>--}}
            {{--                                            </li>--}}
            {{--                                        </ul>--}}

            {{--                                        <!-- Right Side Of Navbar -->--}}
            {{--                                        <ul class="navbar-nav ml-auto">--}}
            {{--                                            <!-- Authentication Links -->--}}
            {{--                                            @guest--}}
            {{--                                                <li class="nav-item">--}}
            {{--                                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
            {{--                                                </li>--}}
            {{--                                                @if (Route::has('register'))--}}
            {{--                                                    <li class="nav-item">--}}
            {{--                                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
            {{--                                                    </li>--}}
            {{--                                                @endif--}}
            {{--                                            @else--}}
            {{--                                                <li class="nav-item dropdown">--}}
            {{--                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
            {{--                                                        <img src="{{ asset('storage/images/avatars') . '/' . Auth::user()->avatar }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px" alt="">--}}

            {{--                                                        {{ Auth::user()->name }} <span class="caret"></span>--}}
            {{--                                                    </a>--}}

            {{--                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
            {{--                                                        <a class="dropdown-item" href="{{ route('profile', Auth::user()->id) }}"><i class="fas fa-user"></i> Profile</a>--}}

            {{--                                                        <a class="dropdown-item" href="{{ route('logout') }}"--}}
            {{--                                                           onclick="event.preventDefault();--}}
            {{--                                                                         document.getElementById('logout-form').submit();">--}}
            {{--                                                            {{ __('Logout') }}--}}
            {{--                                                        </a>--}}

            {{--                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
            {{--                                                            @csrf--}}
            {{--                                                        </form>--}}
            {{--                                                    </div>--}}
            {{--                                                </li>--}}
            {{--                                            @endguest--}}
            {{--                                        </ul>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </nav>--}}
            <!--Navbar-->
                <nav class="navbar navbar-expand-lg  pink lighten-3 mb-4">

                    <!-- Collapsible content -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <!-- Search form -->
                        <search></search>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item top">
                                <a class="nav-link" href="#">
                    <span class="bell-not icon">
                        <i class="far fa-bell"></i>
                    </span>
                                    <span class="nav-text">Уведомления</span>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img src="{{ asset('storage/images/avatars') . '/' . Auth::user()->avatar }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px" alt="">

                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile', Auth::user()->id) }}"><i class="fas fa-user"></i> Profile</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                    </ul>
                @endguest
                <!-- Links -->

                </nav>
                <div class="wrapper" style="background-color: #f6e6e0 ">
                    @yield('content')
                </div>

            </div>
        </div>
    </div>
    {{--        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">--}}
    {{--            <div class="container">--}}
    {{--                <a class="navbar-brand" href="{{ url('/') }}">--}}
    {{--                    {{ config('app.name', 'Laravel') }}--}}
    {{--                </a>--}}
    {{--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">--}}
    {{--                    <span class="navbar-toggler-icon"></span>--}}
    {{--                </button>--}}

    {{--                <div class="collapse navbar-collapse" id="navbarSupportedContent">--}}
    {{--                    <!-- Left Side Of Navbar -->--}}
    {{--                    <ul class="navbar-nav mr-auto">--}}
    {{--                        <li class="nav-item">--}}
    {{--                            <a href="{{ route('add-post') }}">Добавить пост</a>--}}
    {{--                        </li>--}}
    {{--                    </ul>--}}

    {{--                    <!-- Right Side Of Navbar -->--}}
    {{--                    <ul class="navbar-nav ml-auto">--}}
    {{--                        <!-- Authentication Links -->--}}
    {{--                        @guest--}}
    {{--                            <li class="nav-item">--}}
    {{--                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>--}}
    {{--                            </li>--}}
    {{--                            @if (Route::has('register'))--}}
    {{--                                <li class="nav-item">--}}
    {{--                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>--}}
    {{--                                </li>--}}
    {{--                            @endif--}}
    {{--                        @else--}}
    {{--                            <li class="nav-item dropdown">--}}
    {{--                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>--}}
    {{--                                    <img src="{{ asset('storage/images/avatars') . '/' . Auth::user()->avatar }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px" alt="">--}}

    {{--                                    {{ Auth::user()->name }} <span class="caret"></span>--}}
    {{--                                </a>--}}

    {{--                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">--}}
    {{--                                    <a class="dropdown-item" href="{{ route('profile', Auth::user()->id) }}"><i class="fas fa-user"></i> Profile</a>--}}

    {{--                                    <a class="dropdown-item" href="{{ route('logout') }}"--}}
    {{--                                       onclick="event.preventDefault();--}}
    {{--                                                     document.getElementById('logout-form').submit();">--}}
    {{--                                        {{ __('Logout') }}--}}
    {{--                                    </a>--}}

    {{--                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
    {{--                                        @csrf--}}
    {{--                                    </form>--}}
    {{--                                </div>--}}
    {{--                            </li>--}}
    {{--                        @endguest--}}
    {{--                    </ul>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </nav>--}}
</div>
@yield('scripts')

</body>
</html>
