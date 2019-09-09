@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Темы</h1>
        <div class="btn-group" role="group" aria-label="Basic example">
            <a href="{{ route('tags') }}" class="btn btn-secondary">По публикациям</a>
            <a href="{{ route('tags', 'followers') }}" class="btn btn-secondary">По подписчикам</a>
        </div>
        <div id="tags">
            @foreach($tags as $tag)
                @include('tag.part')
            @endforeach
        </div>

        <div id="load">
            <button id="load-more" class="btn btn-primary form-control"><i class="fas fa-arrow-down"></i>Смотреть ещё</button>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {
            $('.follow').click(function () {
                ajaxAction($(this), 'tag');
            });
            $('.unfollow').click(function () {
                ajaxAction($(this), 'tag');
            });

            $('#load-more').click(
                function(){
                    let ids = [];
                    let tags = $('.card');
                    for(let tag of tags)
                    {
                        ids.push($(tag).data('id'));
                    }
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: '{{url()->current()}}',
                        data: {ids: ids},
                        success: function(data){
                            console.log(data);
                            $('#tags').append(data);
                        },
                        error: function () {
                            alert(1);
                        }
                    });
                });
        });
    </script>

@endsection
