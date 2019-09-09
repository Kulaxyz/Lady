@extends('layouts.app')

@section('content')

    @foreach($users as $user)
        <div>
            <div>
                {{$user->name}}
            </div>
            <span>
                {{auth()->user()->lastMessage($user->id)->message}}
            </span>
        </div>
    @endforeach

@endsection
