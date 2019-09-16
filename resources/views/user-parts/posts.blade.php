@extends('profile')

@section('inner')
        <h2>Публикации</h2>

        @if($posts->isNotEmpty())
        <posts :posts="{{$posts}}"></posts>
        @else
            <h3>У вас пока нет публикаций... <a href="{{ route('add-post') }}">Добавить</a></h3>
        @endif

@endsection
@section('scripts')
{{--    <script type="text/javascript" src="{{asset('js/load-more.js')}}"></script>--}}
@endsection
