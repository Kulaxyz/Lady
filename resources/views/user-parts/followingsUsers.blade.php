@extends('profile')

@section('inner')
    <div class="wrap-profile-content">
        <div class="wrap-topic">
            <h2>Подписки</h2>
            <div class="tape-tabs">
                <ul>
                    <li><a href="{{route('profile-follows', $user->id)}}">Темы</a></li>
                    <li class="active"><a href="#">Пользователи</a></li>
                </ul>
            </div>
            <div class="wrap-followers">
                @foreach($follows as $follower)
                    <div class="followers-el">
                        <a href="{{route('profile', $follower->id)}}">
                            <div class="profile_user">
                                <div class="profile_user_img" style="background-image: url(/storage/images/avatars/{{ $follower->avatar}});"></div>
                                <div class="profile_user_name" style="margin-bottom: 15px">
                                    <p>{{$follower->name}}</p>
                                </div>
                            </div>
                        </a>
                        @auth
                            <div onclick="ajaxAction($(this), 'users')" class="follow" @if(Auth::user()->isFollowing($follower)) hidden @endif data-id="{{ $follower->id }}">
                                <div class="btn_subscribe">
                                    <a class="user-name-follow">Подписаться</a>
                                </div>
                            </div>

                            <div onclick="ajaxAction($(this), 'users')" class="unfollow" @if(!(Auth::user()->isFollowing($follower))) hidden @endif data-id="{{ $follower->id }}">
                                <div class="btn_unscribe profile_user_btn btn-green">
                                    <a class="user-name-follow">Отписаться</a>
                                </div>
                            </div>
                        @endauth

                    </div>
                @endforeach
            </div>
            <div onclick="loadFollowers()" class="btn-green tapes-else">
                <a href="#">Смотреть еще <img src="/img/tape/else_icon.png" alt=""></a>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{--    <script src="{{ asset('js/follow.js') }}"></script>--}}
    <script type="text/javascript">

        function loadFollowers() {
            console.log(43);
            let ids = [];
            let followers = $('.follow, .unfollow');
            for (let follower of followers) {
                ids.push($(follower).data('id'));
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{url()->current()}}',
                data: {ids: ids},
                success: function (data) {
                    $('.wrap-followers').append(data);
                },
                error: function () {
                    alert(1);
                }
            });
        }

        $( document ).ready(function() {
            console.log(3)
            $('.follow').click(function () {
                console.log(this)
                ajaxAction($(this), 'users');
            });
            $('.unfollow').click(function () {
                console.log(this)
                ajaxAction($(this), 'users');
            });
        });
    </script>

@endsection
