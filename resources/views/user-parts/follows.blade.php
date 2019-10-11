@extends('profile')

@section('inner')
        <div class="wrap-profile-content">
            <div class="wrap-topic">
                <h2>Подписки</h2>
                <div class="tape-tabs">
                    <ul>
                        <li class="active"><a>Темы</a></li>
                        <li><a href="{{ route('profile-follows-users', $user->id) }}">Пользователи</a></li>
                    </ul>
                </div>
                <div class="wrap-topic-content">
                    @foreach($tags as $tag)
                        @include('tag.part')
                    @endforeach
                </div>

                <div onclick="loadTags()" class="btn-green tapes-else">
                    <a >Смотреть еще <img src="/img/tape/else_icon.svg" alt=""></a>
                </div>
            </div>
        </div>
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
