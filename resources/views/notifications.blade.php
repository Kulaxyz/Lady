@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Уведомления</h1>
        <ul class="list-group">
            @if(Auth::user()->unreadNotifications()->where('type', '=', \App\Notifications\NewComment::class)->count() <= 10)
                    @forelse(Auth::user()->notifications()
                        ->where('type', '=', \App\Notifications\NewComment::class)
                        ->take(10)
                        ->get() as $notification)
                        <li class="list-group-item">
                            {!! $notification->data['data'] !!}
                        </li>
                    @empty
                      <h4>You have no notifications</h4>
                    @endforelse
            @else
                @foreach(Auth::user()
                    ->unreadNotifications()
                    ->where('type', '=', \App\Notifications\NewComment::class)
                    ->get() as $notification)
                    <li class="list-group-item">
                        {!! $notification->data['data'] !!}
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "GET",
                    url: '/mark-read',
                    success: function (data) {
                        console.log(1);
                    },
                    error: function (data) {
                        alert(data);
                    }
                });
        })
    </script>
@endsection
