@extends('layouts.app')

@section('content')

    <chat :user="{{ auth()->user() }}" :active-friend="{{ $id }}"></chat>

@endsection
