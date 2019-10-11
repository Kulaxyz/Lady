@extends('layouts/app')
@section('content')
    <div class="tape-tabs">
        <ul>
            <li class="{{ (request()->is('*favorites/followables')) ? 'active' : '' }}">
                <a href="{{route('favorites') . '/followables'}}">По дате добавления</a>
            </li>
            <li class="{{ (request()->is('*favorites')) ? 'active' : '' }}">
                <a href="{{route('favorites')}}">По дате публикации</a>
            </li>
        </ul>
    </div>

    <posts :posts="{{$posts}}"></posts>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/load-more.js')}}"></script>
@endsection
