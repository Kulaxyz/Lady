@php
    if (isset($approved) and $approved == true) {
        $comments = $model->approvedComments;
    } else {
        $comments = $model->comments;
    }
@endphp

@if($comments->count() < 1)
    <div class="detail-content-noCommnets">
        <p class="noCommnets__text">Пока никто не прокомментировал...</p>
    </div>
@endif

<div class="publication-detail-content-comments">
    <div class="detail-content-comments-else">
        <div class="btn-green tapes-else">
            <a href="#">
                Смотреть еще
                <img src="/img/tape/else_icon.svg" alt="">
            </a>
        </div>
    </div>

    <div class="detail-content-comments">
        <ul class="content-comments">

        @php
        $grouped_comments = $comments->sortBy('created_at')->groupBy('child_id');
    @endphp
    @foreach($grouped_comments as $comment_id => $comments)
        {{-- Process parent nodes --}}
        @if($comment_id == '')
            @foreach($comments as $comment)
                @if($comment->commenter->id != 29)
                    @include('comments::_comment', [
                        'comment' => $comment,
                        'grouped_comments' => $grouped_comments
                    ])
                @endif
            @endforeach
        @endif
    @endforeach
</ul>
    </div>
</div>
@auth
    @include('comments::_form')
@elseif(config('comments.guest_commenting') == true)
    @include('comments::_form', [
        'guest_commenting' => false
    ])
@else
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Только для зарегестрированных пользователей!</h2>
            <p class="card-text"><h4>Зарегестрируйтесь или войдите, чтобы комментировать записи</h4></p>
            <a href="{{ route('login') }}" class="btn btn-primary signIn_open ">Войти</a>
        </div>
    </div>
@endauth
