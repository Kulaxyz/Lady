@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="wrapper">
            <div class="float-left">
                <div class="user col-9">
                <span>
                    Автор:
                </span>
                    @if(!$post->is_anonimous)
                    <a href="{{route('profile', $user->id)}}">
                        <img src="{{ asset('storage/images/avatars') . '/' . $user->avatar }}"
                             style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px" alt="">
                        <span>{{ $user->name }} </span>
                    </a>
                    @else
                        <img src="{{ asset('storage/images/avatars') . '/default.jpg' }}" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px"  alt="">
                        <span>{{ 'Аноним' }}</span>
                    @endif
                </div>
            </div>
            <hr>

            @if(Auth::user())
                <span id="likes" @if(Auth::user()->hasLiked($post)) class="dislike" @else class="like" @endif>
                        <i class="fas fa-heart"></i>
                </span>
                <div class="favorite icon">
                    <span id="favorites" @if(Auth::user()->hasFavorited($post)) class="unfavorite"
                          @else class="favorite" @endif >
                        <i class="fas fa-bookmark"></i>
                    </span>
                    <label for="favorites"> Добавить в избранное</label>
                </div>
                <hr>
            @endif
            @can('delete-post', $post)
                <form action="{{ route('destroy', $post->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            @endcan
            @foreach($tags as $tag)
                <span class="btn">
                        <a href="{{ route('tag', $tag->id) }}">
                            {{ $tag->name }}
                        </a>
                    </span>
            @endforeach
            <div class="title">
                <h1 class="text-lg-center">
                    {{ $post->title }}
                </h1>
            </div>

            <div class="text-body">
                <article>
                    {{ $post->description }}
                </article>
            </div>

        </div>
    </div>
    <div class="container">
        <div class="row">
            @if($post->options->isNotEmpty())
                    <div class="opt col-md-3" @if(Auth::check() && Auth::user()->hasVoted($post->id)) style="display: none" @endif>
                        <div class="panel">
                            <!-- <div class="panel-heading">
                                 <h3 class="panel-title">
                                     <span class="glyphicon glyphicon-arrow-right"></span>How is My Site? <a href="http://www.jquery2dotnet.com" target="_blank"><span
                                         class="glyphicon glyphicon-new-window"></span></a>
                                 </h3>
                             </div> -->
                            <div class="panel-body">
                                <ul class="list-group">
                                    @foreach($options as $option)
                                        <li class="list-group-item">
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" id="radio-option" value="{{ $option->id }}"
                                                           name="optionsRadios">
                                                    {{ $option->name }}
                                                </label>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!--div class="panel-footer">
                                <button type="button" class="btn btn-primary btn-sm">
                                    Vote</button>
                                <a href="#">View Result</a></div> -->
                        </div>
                    </div>
                    <div class="res col-md-5" @if(!Auth::check() || !Auth::user()->hasVoted($post->id)) style="display:none;" @endif>
                        <div id="results" class="mt-3 mb-5">
                            @foreach($options as $option)
                                <div class="option">
                                    <strong>{{ $option->name }}</strong><span class="pull-right">{{ (int) $option->percent()}}% ({{ $option->countVotes() }})</span>
                                    <div class="progress progress-danger active">
                                        <div class="progress-bar" style="width: {{$option->percent()}}%"></div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
            @endif
                @if(!is_null($images))
                    <div class="card-img">
                        @foreach($images as $img)
                            <span class="img-fluid">
                        <img src="{{ asset('storage/images/posts') . '/' . $img->path }}" style="width: 200px" alt="">
                    </span>
                        @endforeach
                    </div>
                @endif
        </div>
        <hr>
        <h1>Комментарии</h1>
        @comments(['model' => $post])
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


            $('input:radio[name="optionsRadios"]').change(
                function () {
                    @if(!Auth::user())  window.location.replace("{{route('login')}}"); @endif
                    if ($(this).is(':checked')) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: "POST",
                            url: "/posts/vote",
                            data: 'option_id=' + this.value + '&post_id=' + {{ $post->id }},
                            success: function (data) {
                                $('#results').html(data);
                                $('.res').show();
                                $('.opt').hide();
                            }
                        });

                    }
                });
        });
    </script>
@endsection
