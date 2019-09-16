@extends('layouts.app')
@section('content')
    <section class="sec-notification">
        <div class="wrap-notification">
            <h2>Уведомления</h2>
            <div class="wrap-notification-content">
                @if(Auth::user()->unreadNotifications()->where('type', '=', \App\Notifications\NewComment::class)->count() <= 10)
                    @forelse(Auth::user()->notifications()
                        ->where('type', '=', \App\Notifications\NewComment::class)
                        ->take(10)
                        ->get() as $notification)
                        <div class="notification-content-el">
                            <div class="notification-content-el-info">
{{--                                <div class="notification-content-el-info_userpic" style="background-image: url(/img/profile_user.png);"></div>--}}
                                <p>
                                    {!! $notification->data['data'] !!}
                                </p>
                            </div>
                            <div class="notification-content-el-time">
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @empty
                        <h4>У вас нет новых уведомлений</h4>
                    @endforelse
                @else
                    @foreach(Auth::user()
                        ->unreadNotifications()
                        ->where('type', '=', \App\Notifications\NewComment::class)
                        ->get() as $notification)
                        <div class="notification-content-el">
                            <div class="notification-content-el-info">
                                {{--                                <div class="notification-content-el-info_userpic" style="background-image: url(/img/profile_user.png);"></div>--}}
                                <p>
                                    {!! $notification->data['data'] !!}
                                </p>
                            </div>
                            <div class="notification-content-el-time">
                                <span>{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endforeach
                @endif

    </section>

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
