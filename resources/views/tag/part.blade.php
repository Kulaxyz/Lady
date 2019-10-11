    <div class="topic-content-el">
        <h4><a href="{{route('tag', $tag->slug)}}">{{ $tag->name }}</a></h4>
        <ul>
            <li>Публикаций {{ $tag->posts_count }}</li>
            <li>Подписчиков {{ $tag->followers_count }}</li>
        </ul>
        @auth
            <div onclick="ajaxAction($(this), 'tag')" class="follow" @if(Auth::user()->isFollowing($tag)) hidden @endif data-id="{{ $tag->id }}">
                <div class="btn_subscribe">
                     <a class="btn btn-primary">Подписаться</a>
                </div>
            </div>

            <div onclick="ajaxAction($(this), 'tag')" class="unfollow" @if(!Auth::user()->isFollowing($tag)) hidden @endif data-id="{{ $tag->id }}">
                <div class="btn_unscribe">
                        <a class="btn btn-light">Отписаться</a>
                </div>
            </div>
        @endauth
    </div>

{{--@auth--}}



{{--    <span class="follow" @if(Auth::user()->isFollowing($tag)) hidden @endif data-id="{{ $tag->id }}">--}}
{{--                    <span class="btn btn-primary">Подписаться</span>--}}
{{--                </span>--}}

{{--    <span class="unfollow" @if(!Auth::user()->isFollowing($tag)) hidden @endif data-id="{{ $tag->id }}">--}}
{{--                    <span class="btn btn-light">Отписаться</span>--}}
{{--                </span>--}}
{{--@endauth--}}

