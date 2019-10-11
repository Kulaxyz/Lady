@extends('layouts.app')

@section('content')
    @auth
        <dialogs :dialogers="{{$users}}" :user="{{auth()->user()}}"></dialogs>
    @endauth
@endsection
