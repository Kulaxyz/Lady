@extends('layouts/app')
@section('content')
    <section class="sec-tape">
        <div class="tape-tabs">
            <ul>
                <li class="{{request()->is('*my/tags*') ? 'active' : ''}}"><a href="{{ route('my-tags') }}">По темам</a></li>
                <li class="{{request()->is('*my/users*') ? 'active' : ''}}"><a href="{{ route('my-users') }}">По пользователям</a></li>
            </ul>
        </div>

        <posts :posts="{{ $posts }}"></posts>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/load-more.js')}}"></script>
@endsection

