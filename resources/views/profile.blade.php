@extends('layouts.app')
@section('content')
    @php $owner = $user->id == Auth::user()->id @endphp
    <div>
        <img class="user-avatar" src="{{ asset('storage/images/avatars') . '/' . $user->avatar }}"alt="">
    </div>
    <h2>{{$user->name}}</h2>
    @if($owner)
        <form style=" padding-left: 40px; padding-top: 40px" action="/avatar" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <input name="avatar" id="file" style="display: none"  class="form-control" type="file">
            <label for="file">Choose avatar</label>
            <input type="submit" class="btn btn-primary">
        </form>
        @else
        @auth

            <span class="follow" @if(Auth::user()->isFollowing($user)) hidden @endif data-id="{{ $user->id }}">
                    <span class="btn btn-primary">Подписаться</span>
                </span>

            <span class="unfollow" @if(!Auth::user()->isFollowing($user)) hidden @endif data-id="{{ $user->id }}">
                    <span class="btn btn-light">Отписаться</span>
                </span>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="btn btn-primary">Подписаться</a>
        @endguest
    @endif
    <div class="col-md-3">
        <div class="card border-dark mb-3 col-3" style="max-width: 18rem;">
            <div class="card-header">Публикации</div>
            <div class="card-body text-dark">
                <p class="card-text">{{$user->posts_count}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-dark mb-3 col-3" style="max-width: 18rem;">
            <div class="card-header">Закладки</div>
            <div class="card-body text-dark">
                <p class="card-text">{{$favorites}}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-dark mb-3 col-3" style="max-width: 18rem;">
            <div class="card-header">Подписки</div>
            <div class="card-body text-dark">
                <p class="card-text">{{ $followings }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-dark mb-3 col-3" style="max-width: 18rem;">
            <div class="card-header">Подписчики</div>
            <div class="card-body text-dark">
                <p class="card-text">{{ $followers }}</p>
            </div>
        </div>
    </div>

    @yield('inner')

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
