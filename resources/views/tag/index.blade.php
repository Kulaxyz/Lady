@extends('layouts.app')
@section('content')

    <section class="sec-topic">
        <div class="wrap-topic">
            <h2>Темы</h2>
            <div class="tape-tabs">
                <ul>
                    <li class="{{ (request()->is('*tags')) ? 'active' : '' }}"><a href="{{ route('tags') }}">По количеству публикаций</a></li>
                    <li class="{{ (request()->is('*tags/followers')) ? 'active' : '' }}"><a href="{{ route('tags', 'followers') }}">По подписчикам</a></li>
                </ul>
            </div>
            <div class="wrap-topic-content">
                @foreach($tags as $tag)
                    @include('tag.part')

                @endforeach
            </div>

            <div onclick="loadTags()" class="btn-green tapes-else">
                <a >Смотреть еще <img src="/img/tape/else_icon.png" alt=""></a>
            </div>
        </div>
    </section>


{{--    <div class="container">--}}
{{--        <h1>Темы</h1>--}}
{{--        <div class="btn-group" role="group" aria-label="Basic example">--}}
{{--            <a href="{{ route('tags') }}" class="btn btn-secondary">По публикациям</a>--}}
{{--            <a href="{{ route('tags', 'followers') }}" class="btn btn-secondary">По подписчикам</a>--}}
{{--        </div>--}}
{{--        <div id="tags">--}}
{{--            @foreach($tags as $tag)--}}
{{--                @include('tag.part')--}}
{{--            @endforeach--}}
{{--        </div>--}}

{{--        <div id="load">--}}
{{--            <button id="load-more" class="btn btn-primary form-control"><i class="fas fa-arrow-down"></i>Смотреть ещё</button>--}}
{{--        </div>--}}
{{--    </div>--}}
@endsection
@section('scripts')
{{--    <script src="{{ asset('js/follow.js') }}"></script>--}}
    <script type="text/javascript">

        function loadTags() {
            console.log(43);
            let ids = [];
            let tags = $('.follow, .unfollow');
            for (let tag of tags) {
                ids.push($(tag).data('id'));
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: '{{url()->current()}}',
                data: {ids: ids},
                success: function (data) {
                    $('.wrap-topic-content').append(data);
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
                ajaxAction($(this), 'tag');
            });
            $('.unfollow').click(function () {
                console.log(this)
                ajaxAction($(this), 'tag');
            });
        });
    </script>

@endsection
