@extends('layouts/app')
@section('content')
    <section class="sec-tape">
        <h2>Моя лента</h2>
        <div class="tape-tabs">
            <ul>
                <li class="active"><a href="{{ route('my-tags') }}">По темам</a></li>
                <li><a href="{{ route('my-users') }}">По подпискам</a></li>
            </ul>
        </div>

        <posts :posts="{{ $posts }}"></posts>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/load-more.js')}}"></script>
@endsection

