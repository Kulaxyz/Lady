@extends('layouts/app')

@section('content')
    <section class="sec-publication-detail">
        <div class="wrap-publication-detail">
            <div class="wrap-publication-detail-content">
                <div class="publication-detail-content-main">
                    <div class="detail-content-main-info">
                        <div class="detail-content-main-info-top">
                            <div class="detail-content-main-info-star">
                                @if($post->type == 'post')
                                    <img src="/img/tape/star.svg" alt="">
                                @elseif($post->type == 'vote')
                                    <img src="/img/tape/speaker.svg" alt="">
                                @elseif($post->type == 'question')
                                    <img src="/img/tape/ask.svg" alt="">
                                @endif
                            </div>

                            <div class="detail-content-main-info-time">
                                <span>{{$post->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                        @can('delete-post', $post)
                            <form action="{{ route('destroy', $post->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" style="border: 2px solid red; margin-top: 10px; padding: 5px; border-radius: 10px;" class="btn-green">Удалить</button>
                            </form>
                        @endcan
{{--                        <div style="display: flex">--}}
{{--                        <h4 style="margin-top: 20px; width: fit-content; margin-right: 15px">Темы:</h4>--}}
{{--                        @foreach($post->tags as $tag)--}}

{{--                            <div class="single-tag">--}}
{{--                                <a href="{{route('tag', $tag->slug)}}"><span>{{ $tag->name }}</span></a>--}}
{{--                            </div>--}}
{{--                        @endforeach--}}
{{--                        </div>--}}
                        <div class="detail-content-main-info-text">
                            <h1 style="font-size: 23px; margin-bottom: 23px">{{ $post->title }}</h1>
                            <p>{{ $post->description }}</p>
                        </div>
                        @if(($images->isNotEmpty()))
                            @if(count($images) > 1)
                                <div class="detail-content-main-info-slider">
                                    <div class="images">
                                    @foreach($images as $image)
                                        <div class="images-el"><img src="/storage/images/posts/{{$image->path}}" alt=""></div>
                                    @endforeach
                                    </div>

                                    <div class="imagesnew_dotted" style="transform: none !important;">
                                        @foreach($images as $image)
                                            <div class="imagesnew_dotted-el">
                                                <img src="/storage/images/posts/{{$image->path}}" alt="">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @else
                                 <div class="detail-content-main-info-oneImg">
                                    <img src="/storage/images/posts/{{$images[0]->path}}" alt="">
                                </div>
                            @endif
                        @endif

                        @if($post->type == 'vote')
                        <!-- class voted - состояние посел -->
                            <votes :voted="@auth @if(Auth::user()->hasVoted($post->id)) 'voted' @else  '' @endif @endauth
                            @guest '' @endguest" :post="{{$post->id}}"></votes>
                        @endif
                    </div>

                    <div class="block-tags">
                        <h4 class="block-tags__title">Темы:</h4>
                        <div class="block-tags-content">
                            @foreach($tags as $tag)
                                <div class="tag-content btn-green">
                                    <a href="{{route('tag', $tag->slug)}}">{{$tag->name}}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="detail-content-main-activity">
                        @if($post->is_anonimous)
                        <div class="user-tape">
                            <img class="user-tape-img" src="/storage/images/avatars/default.jpg">
                            <span><a>Аноним</a></span>
                        </div>
                        @else
                        <div class="user-tape" >
                            <div class="user-img" style="background-image: url(/storage/images/avatars/{{$post->user->avatar}});"></div>
                            <span><a href='/user/{{$post->user->id}}'>{{$post->user->name}}</a></span>
                        </div>
                        @endif
                        <activities
                            :Post="{{$post}}" :liked="{{$post->isLikedBy(auth()->user()) ? 1 : 0}}"
                            :favorited="{{$post->isFavoritedBy(auth()->user()) ? 1 : 0}}"
                            :disliked="{{$post->isBookmarkedBy(auth()->user()) ? 1 : 0}}"></activities>
                    </div>
                    @comments(['model' => $post])

                </div>
                </div>
            </div>
        </div>
    </section>


    </div>
@endsection
