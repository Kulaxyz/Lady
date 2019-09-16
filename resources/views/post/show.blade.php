@extends('layouts/app')

@section('content')
    <section class="sec-publication-detail">
        <div class="wrap-publication-detail">
            <div class="wrap-publication-detail-content">
                <div class="publication-detail-content-main">
                    <div class="detail-content-main-info">
                        <div class="detail-content-main-info-top">
                            <div class="detail-content-main-info-star">
                                <img src="/img/star.png" alt="">

                            </div>

                            <div class="detail-content-main-info-time">
                                <span>{{$post->created_at->diffForHumans()}}</span>
                            </div>
                        </div>
                        <div style="display: flex">
                        <h4 style="margin-top: 20px; width: fit-content; margin-right: 15px">Темы:</h4>
                        @foreach($post->tags as $tag)

                            <div class="single-tag">
                                <a href="/tags/single/{{$tag->id}}"><span>{{ $tag->name }}</span></a>
                            </div>
                        @endforeach
                        </div>
                        <div class="detail-content-main-info-text">
                            <h3>{{ $post->title }}</h3>
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

                                <div style="display: flex; justify-content: center">
                                    <img src="/storage/images/posts/{{$images[0]->path}}" alt="">
                                </div>
                            @endif
                        @endif

                        @if($post->type == 'vote')
                        <!-- class voted - состояние посел -->
                            <votes :voted="@if(Auth::user()->hasVoted($post->id)) 'voted' @else  '' @endif " :post="{{$post->id}}"></votes>
                        @endif
                    </div>
                    <div class="detail-content-main-activity">
                        @if($post->is_anonimous)
                        <div class="user-tape">
                            <img class="user-tape-img" src="/storage/images/avatars/default.jpg">
                            <span><a>Аноним</a></span>
                        </div>
                        @else
                        <div class="user-tape" >
                            <img class="user-tape-img" src="/storage/images/avatars/{{ $post->user->avatar}}">
                            <span><a href='/user/{{$post->user->id}}'>{{$post->user->name}}</a></span>
                        </div>
                        @endif
                        <div class="content-main-activities">
                            <div class="activity-el">
                                <div class="activity-el_img">
                                    <img src="/img/tape/like.png" alt="">
                                </div>
                                <div class="activity-el_count">
                                    <span>{{$post->likers_count}}</span>
                                </div>
                            </div>
                            <div class="activity-el">
                                <div class="activity-el_img">
                                    <img src="/img/tape/bookmark.png" alt="">
                                </div>
                                <div class="activity-el_count">
                                    <span>{{$post->favoriters_count}}</span>
                                </div>
                            </div>
                            <div class="activity-el">
                                <div class="activity-el_img">
                                    <img src="/img/tape/comment.png" alt="">
                                </div>
                                <div class="activity-el_count">
                                    <span>{{$post->comments_count}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                        <div class="detail-content-comments-else">--}}
{{--                            <div class="btn-green tapes-else">--}}
{{--                                <a href="#">--}}
{{--                                    Смотреть еще--}}
{{--                                    <img src="/img/tape/else_icon.png" alt="">--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="detail-content-comments">--}}
{{--                            <ul class="content-comments">--}}
{{--                                <li class="comment">--}}
{{--                                    <div class="wrap-comment">--}}
{{--                                        <div class="wrap-comment-top">--}}
{{--                                            <div class="comment-top-user">--}}
{{--                                                <div class="user_activity_img"--}}
{{--                                                     style="background-image: url(/img/tape/user.png);">--}}
{{--                                                </div>--}}
{{--                                                <div class="user_activity_name">--}}
{{--                                                    <span>Phoenix</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="comment-top-time">--}}
{{--                                                <span>вчера 11:48</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="wrap-comment-body">--}}
{{--                                            <p>Зачем здоровье? Мы все умрем, вот зачем люди терпят болезненные операции, все равно умрут</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="comment-reply">--}}
{{--                                            <div class="btn-green">--}}
{{--                                                <a href="#">--}}
{{--                                                    Ответить--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <ul class="comments_reply">--}}
{{--                                        <li class="comment_reply">--}}
{{--                                            <div class="wrap-comment">--}}
{{--                                                <div class="wrap-comment-top">--}}
{{--                                                    <div class="comment-top-user">--}}
{{--                                                        <div class="user_activity_img"--}}
{{--                                                             style="background-image: url(/img/tape/user.png);">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="user_activity_name">--}}
{{--                                                            <span>Эльза</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-top-time">--}}
{{--                                                        <span>сегодня 15:24</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="wrap-comment-body">--}}
{{--                                                    <p>Не стягивайте волосы тугими «конскими хвостами», косами, лентами или гребнями на долгое время, потому что это может повредить волосы и даже вызвать алопецию, то есть облысение. уход за волосами</p>--}}
{{--                                                </div>--}}
{{--                                                <div class="comment-reply">--}}
{{--                                                    <div class="comment-reply-input">--}}
{{--                                                        <input class="inp_comment" type="text" placeholder="Напишите сообщение...">--}}
{{--                                                        <div class="comment-reply-input-media">--}}
{{--                                                            <div class="comment-reply-input-media_el">--}}
{{--                                                                <div class="load_media">--}}
{{--                                                                    <label class="unselectable">--}}
{{--                                                                        <input type="file">--}}
{{--                                                                        <img src="/img/camera.png" alt="">--}}
{{--                                                                    </label>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="btn-green">--}}
{{--                                                        <a href="#">--}}
{{--                                                            Ответить--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                        <li class="comment_reply">--}}
{{--                                            <div class="wrap-comment">--}}
{{--                                                <div class="wrap-comment-top">--}}
{{--                                                    <div class="comment-top-user">--}}
{{--                                                        <div class="user_activity_img"--}}
{{--                                                             style="background-image: url(/img/tape/user.png);">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="user_activity_name">--}}
{{--                                                            <span>Эльза</span>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="comment-top-time">--}}
{{--                                                        <span>сегодня 16:30</span>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="wrap-comment-body">--}}
{{--                                                    <p>Не стягивайте волосы тугими «конскими хвостами», косами, лентами или гребнями на долгое время, потому что это..</p>--}}
{{--                                                </div>--}}
{{--                                                <div class="comment-reply">--}}
{{--                                                    <div class="btn-green">--}}
{{--                                                        <a href="#">--}}
{{--                                                            Ответить--}}
{{--                                                        </a>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </li>--}}
{{--                                    </ul>--}}
{{--                                </li>--}}
{{--                                <li class="comment">--}}
{{--                                    <div class="wrap-comment">--}}
{{--                                        <div class="wrap-comment-top">--}}
{{--                                            <div class="comment-top-user">--}}
{{--                                                <div class="user_activity_img"--}}
{{--                                                     style="background-image: url(/img/tape/user.png);">--}}
{{--                                                </div>--}}
{{--                                                <div class="user_activity_name">--}}
{{--                                                    <span>Phoenix</span>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="comment-top-time">--}}
{{--                                                <span>вчера 11:48</span>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="wrap-comment-body">--}}
{{--                                            <p>Зачем здоровье? Мы все умрем, вот зачем люди терпят болезненные операции.</p>--}}
{{--                                        </div>--}}
{{--                                        <div class="comment-reply">--}}
{{--                                            <div class="btn-green">--}}
{{--                                                <a href="#">--}}
{{--                                                    Ответить--}}
{{--                                                </a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                        <div class="detail-content-comments-add">--}}
{{--                            <div class="comment-reply-input">--}}
{{--                                <input class="inp_comment" type="text" placeholder="Напишите сообщение..." data-emojiable="true">--}}
{{--                                <div class="comment-reply-input-media">--}}
{{--                                    <div class="comment-reply-input-media_el">--}}
{{--                                        <div class="load_media">--}}
{{--                                            <label class="unselectable">--}}
{{--                                                <input type="file">--}}
{{--                                                <img src="/img/camera.png" alt="">--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="btn-green">--}}
{{--                                <a href="#">Отправить</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    @comments(['model' => $post])

                </div>
                </div>
            </div>
        </div>
    </section>


    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        function ajaxAction(obj) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '/posts/' + obj[0].className,
                data: 'post_id=' + {{ $post->id }},
                success: function (data) {
                    obj.removeClass();
                    obj.addClass(data);
                },
                error: function (data) {
                    alert(data);
                }
            });
        }

        $(document).ready(function () {
            let likes = $('#likes');
            likes.click(function () {
                ajaxAction(likes);
            });
            let favorites = $('#favorites');
            favorites.click(function () {
                ajaxAction(favorites);
            });
        });
    </script>
@endsection
