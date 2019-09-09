@extends('layouts/app')
@section('content')
    <div class="btn-group" role="group" aria-label="Basic example">
        <a href="{{ route('list', [$filter, 'day']) }}" class="btn btn-secondary">День</a>
        <a href="{{ route('list', [$filter, 'week']) }}" class="btn btn-secondary">Неделю</a>
        <a href="{{ route('list', [$filter, 'month']) }}" class="btn btn-secondary">Месяц</a>
        <a href="{{ route('list', [$filter, 'year']) }}" class="btn btn-secondary">Всё вреся</a>
    </div>

    <div id="posts" class="container-fluid">
    @foreach($posts as $post)
            @include('post.part')
        @endforeach
    </div>

    <div id="load">
        <button id="load-more" class="btn btn-primary form-control"><i class="fas fa-arrow-down"></i>Смотреть ещё</button>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/load-more.js')}}"></script>
@endsection
