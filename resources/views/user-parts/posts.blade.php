@extends('profile')

@section('inner')
    <div class="container">
        <h1>Ваши публикации </h1>

        <div id="posts" class="container-fluid">
            @forelse($posts as $post)
                @include('post.part')

        @empty
            <h3>У вас пока нет публикаций... <a href="{{ route('add-post') }}">Добавить</a></h3>
        @endforelse
        </div>
    </div>
    <div id="load">
        <button id="load-more" class="btn btn-primary form-control"><i class="fas fa-arrow-down"></i>Смотреть ещё</button>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/load-more.js')}}"></script>
@endsection
