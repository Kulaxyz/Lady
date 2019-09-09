<div class="col-lg-3 col-3 d-flex justify-content-center">
    <div class="card" data-id="{{ $tag->id }}">
        <div class="card-body">
            <h5 class="card-title"><a href='{{route('tag', $tag->id) }}'>{{$tag->name}}</a></h5>
            <p class="card-text">{{ $tag->posts_count}} Публикаций</p>

            @auth

                <span class="follow" @if(Auth::user()->isFollowing($tag)) hidden @endif data-id="{{ $tag->id }}">
                    <span class="btn btn-primary">Подписаться</span>
                </span>

                <span class="unfollow" @if(!Auth::user()->isFollowing($tag)) hidden @endif data-id="{{ $tag->id }}">
                    <span class="btn btn-light">Отписаться</span>
                </span>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary">Подписаться</a>
            @endguest
{{--            <a href="{{ route('follow-tag', $tag->id) }}" class="btn btn-primary">Отписаться</a>--}}
        </div>
    </div>
</div>
