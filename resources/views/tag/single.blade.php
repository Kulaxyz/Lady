@extends('layouts/app')
@section('content')
    <h1 style="margin-bottom: 30px">{{$tag->name}}</h1>
    <posts :posts="{{$posts}}">
@endsection
@section('scripts')
    <script type="text/javascript" src="{{asset('js/load-more.js')}}"></script>
@endsection

