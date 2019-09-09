@extends('layouts/app')
@section('content')
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
