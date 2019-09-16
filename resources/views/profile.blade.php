@extends('layouts.app')
@section('content')
    @php $owner = $user->id == Auth::id() @endphp
    <section class="sec-profile">
        <div class="wrap-profile">
            @if($owner)
            <h2>Мой профиль</h2>
            @endif
            <div class="profile_user">
                <div class="profile_user_img" style="background-image: url(/storage/images/avatars/{{ $user->avatar}});"></div>
                <div class="profile_user_name">
                    <p>{{$user->name}}</p>
                </div>
                @if(!$owner)
                    <span onclick="ajaxAction($(this), 'users')" class="follow"
                         @if(Auth::user()->isFollowing($user)) hidden @endif
                         data-id="{{ $user->id }}">

                        <div class="profile_user_btn subscribe">
                            <a class="user-name-follow">Подписаться</a>
                        </div>
                    </span>
                    <span onclick="ajaxAction($(this), 'users')" class="unfollow"
                         @if(!(Auth::user()->isFollowing($user))) hidden @endif
                         data-id="{{ $user->id }}">

                    <div class="profile_user_btn unscribe btn-green">
                        <a class="user-name-follow">Отписаться</a>
                    </div>
                    </span>
                    <div class="btn-green write-message">
                        <a href="#">Написать сообщение</a>
                    </div>
                @endif
            </div>

                <div class="profile_tabs">
                <ul>
                    <li class="{{ (request()->is("*user/$user->id")) ? 'active' : '' }}">
                        <a href="{{ route('profile', $user->id) }}">
                            <h5>Публикации</h5>
                            <span>{{$user->posts_count}}</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is("*user/*/follows*")) ? 'active' : '' }}">
                        <a href="{{route('profile-follows', $user->id)}}">
                            <h5>Подписки</h5>
                            <span>{{$user->followings_count}}</span>
                        </a>
                    </li>
                    <li class="{{ (request()->is("*user/*/followers")) ? 'active' : '' }}">
                        <a href="{{ route('profile-followers', $user->id) }}">
                            <h5>Подписчики</h5>
                            <span>{{$user->followers_count}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="profile_settigns">
                <div class="profile_settigns-el">
                    <a href="/pages/settings.html">
                        <div class="profile_settigns-el-content">
                            <div class="profile_settigns-el-icon">
                                <img src="/img/settigns.png" alt="">
                            </div>
                            <span>Настройки</span>
                        </div>
                    </a>
                </div>
                <div class="profile_settigns-el">
                    <div class="profile_settigns-el-content">
                        <div class="profile_settigns-el-icon">
                            <img src="/img/exit.png" alt="">
                        </div>
                        <span>Выйти</span>
                    </div>
                </div>
            </div>
            <div class="wrap-profile-content">
                @yield('inner')
            </div>
        </div>
    </section>


@endsection
@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.follow').click(function () {
                ajaxAction($(this), 'user');
            });
            $('.unfollow').click(function () {
                ajaxAction($(this), 'user');
            });
        });
        </script>
@endsection
