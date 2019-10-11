@inject('markdown', 'Parsedown')
@php($markdown->setSafeMode(true))

@if(isset($reply) && $reply === true)
    <div id="comment-{{ $comment->id }}" class="media comment">
        @else
            <li id="comment-{{ $comment->id }}" class="media comment">
                @endif
                {{--      @if(!$comment->anonimous)--}}
                {{--          <img src="{{ asset('storage/images/avatars') . '/' . $comment->commenter->avatar }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px" alt="{{$comment->commenter->name }} Аватар">--}}
                {{--          <div class="media-body">--}}
                {{--            <h5 class="mt-0 mb-1"><a href="{{ route('profile', $comment->commenter->id) }}">{{ $comment->commenter->name ?? $comment->guest_name }} </a><small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>--}}
                {{--       @else--}}
                {{--          <img src="{{ asset('storage/images/avatars/') . '/' . 'default.jpg' }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px" alt="{{$comment->fake_name }} Аватар">--}}
                {{--          <div class="media-body">--}}
                {{--            <h5 class="mt-0 mb-1">{{ $comment->fake_name ?? $comment->guest_name }}<small class="text-muted">- {{ $comment->created_at->diffForHumans() }}</small></h5>--}}

                {{--       @endif--}}
                {{--          <div style="white-space: pre-wrap;">{!! $markdown->line($comment->comment) !!}</div>--}}

                {{--        <div>--}}
                {{--            @can('reply-to-comment', $comment)--}}
                {{--                <button data-toggle="modal" data-target="#reply-modal-{{ $comment->id }}" class="btn btn-sm btn-link text-uppercase">Ответить</button>--}}
                {{--            @endcan--}}
                {{--            @can('edit-comment', $comment)--}}
                {{--                <button data-toggle="modal" data-target="#comment-modal-{{ $comment->id }}" class="btn btn-sm btn-link text-uppercase">Редактировать</button>--}}
                {{--            @endcan--}}

                {{--        </div>--}}








                <div class="wrap-comment">
                    <div class="wrap-comment-top">
                        <div class="comment-top-user">
                            <div class="user_activity_img"
                                 style="background-image: url(/storage/images/avatars/{{$comment->commenter->avatar}});">
                            </div>
                            <div class="user_activity_name">
                                <span>{{$comment->commenter->name}}</span>
                            </div>
                        </div>
                        <div class="comment-top-time">
                            <span>{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        @php($comment->likers_count = $comment->likers()->count())
                        @php($comment->bookmarkers_count = $comment->bookmarkers()->count())
                        <comment-activities :comment="{{$comment}}"
                                            :liked="{{$comment->isLikedBy(auth()->user()) ? 1 : 0}}"
                                            :disliked="{{$comment->isBookmarkedBy(auth()->user()) ? 1 : 0}}">
                        </comment-activities>

                    </div>
                    @can('delete-comment', $comment)
                        <a href="{{ url('comments/' . $comment->id) }}"
                           onclick="event.preventDefault();document.getElementById('comment-delete-form-{{ $comment->id }}').submit();"
                           class="btn btn-sm btn-link text-danger text-uppercase">Удалить</a>
                        <form id="comment-delete-form-{{ $comment->id }}" action="{{ url('comments/' . $comment->id) }}" method="POST" style="display: none;">
                            @method('DELETE')
                            @csrf
                        </form>
                    @endcan
                    <div class="wrap-comment-body">
                        <p>{!! $markdown->line($comment->comment) !!}</p>
                    </div>
                    @if($comment->commenter->id != auth()->id())
                        <form id="form-{{$comment->id}}" class="comment-reply-form" method="POST" action="{{ url('comments/' . $comment->id) }}">
                            @csrf
                            <div class="comment-reply">
                                <div class="btn-green">
                                    <a data-id="{{$comment->id}}" href="#" class="reply-comment-btn">
                                        Ответить
                                    </a>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>

{{--                        <div class="comment-reply-input" style="display:none;">--}}
{{--                            <form class="comment-reply-form" method="POST" action="{{ url('comments/' . $comment->id) }}">--}}
{{--                                @csrf--}}
{{--                                <input class="inp_comment" name="message" type="text" placeholder="Напишите сообщение...">--}}
{{--                                <div class="comment-reply-input-media">--}}
{{--                                    <div class="comment-reply-input-media_el">--}}
{{--                                        <div class="load_media">--}}
{{--                                            <label class="unselectable">--}}
{{--                                                <input type="file">--}}
{{--                                                <img src="/img/camera.svg" alt="">--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="btn-green">--}}
{{--                                    <button type="submit">Отправить</button>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}


{{--                        <div onclick="console.log($($($(this).parent()).children()[0]).slideDown()); $(this).slideUp(); " class="btn-green temp">--}}
{{--                            <a>--}}
{{--                                Ответить--}}
{{--                            </a>--}}
{{--                        </div>--}}

                <br>{{-- Margin bottom --}}

            {{-- Recursion for children --}}
            @if(array_key_exists($comment->id, $grouped_comments->toArray()))
                @foreach($grouped_comments[$comment->id] as $child)
                    @if($child->commenter->id != 29)

                    @include('comments::_comment', [
                        'comment' => $child,
                        'reply' => true,
                        'grouped_comments' => $grouped_comments
                    ])
                    @endif
                @endforeach
            @endif

            @if(isset($reply) && $reply === true)
    </div>
    @else
    </li>
@endif
