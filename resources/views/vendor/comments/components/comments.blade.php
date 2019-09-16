@php
    if (isset($approved) and $approved == true) {
        $comments = $model->approvedComments;
    } else {
        $comments = $model->comments;
    }
@endphp

@if($comments->count() < 1)
    <div class="alert alert-warning"><h2>Пока никто не прокомментировал...</h2></div>
@endif

<div class="publication-detail-content-comments">
    <div class="detail-content-comments">
        <ul class="content-comments">

        @php
        $grouped_comments = $comments->sortBy('created_at')->groupBy('child_id');
    @endphp
    @foreach($grouped_comments as $comment_id => $comments)
        {{-- Process parent nodes --}}
        @if($comment_id == '')
            @foreach($comments as $comment)
                @include('comments::_comment', [
                    'comment' => $comment,
                    'grouped_comments' => $grouped_comments
                ])
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
        'guest_commenting' => true
    ])
@else
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Только для зарегестрированных пользователей!</h2>
            <p class="card-text"><h4>Зарегестрируйтесь или войдите, чтобы комментировать записи</h4></p>
            <a href="{{ route('login') }}" class="btn btn-primary">Войти</a>
        </div>
    </div>
@endauth
