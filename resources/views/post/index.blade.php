@extends('layouts/app')
@section('content')
    @if($filter == 'live')
    @elseif($filter == 'popular')
        <div class="tape-tabs">
            <ul>
                <li class="{{ $time == 'day' ? 'active' : '' }}"><a href="{{ route('popular', [ 'day']) }}">24 часа</a></li>
                <li class="{{ $time == 'week' ? 'active' : '' }}"><a href="{{ route('popular', [ 'week']) }}">7 дней</a></li>
                <li class="{{ $time == 'month' ? 'active' : '' }}"><a href="{{ route('popular', ['month']) }}">30 дней</a></li>
                <li class="{{ $time == 'century' ? 'active' : '' }}"><a href='{{ route('popular', ['century']) }}'>Все время</a></li>
            </ul>
        </div>
    @elseif($filter == 'discussed')
        <div class="tape-tabs">
            <ul>
                <li class="{{ $time == 'day' ? 'active' : '' }}"><a href="{{ route('discussed', [ 'day']) }}">24 часа</a></li>
                <li class="{{ $time == 'week' ? 'active' : '' }}"><a href="{{ route('discussed', [ 'week']) }}">7 дней</a></li>
                <li class="{{ $time == 'month' ? 'active' : '' }}"><a href="{{ route('discussed', ['month']) }}">30 дней</a></li>
                <li class="{{ $time == 'century' ? 'active' : '' }}"><a href='{{ route('discussed', ['century']) }}'>Все время</a></li>
            </ul>
        </div>

    @endif

    <posts :posts="{{$posts}}"></posts>


@endsection

{{--<section class="sec-tape">--}}
{{--    <h2>Лента live</h2>--}}
{{--    <div class="wrap-tapes">--}}
{{--        <div class="wrap-tapes-column">--}}
{{--            <article class="tape-content ">--}}
{{--                <div class="tape-content-top">--}}
{{--                    <div class="tape-content-btn">--}}
{{--                        <img src="/img/tape/star.png" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="tape-content-time">--}}
{{--                        <span>2 мин.</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="tape-content-body">--}}
{{--                    <h4>Гормоны мешают тебе похудеть: как их победить</h4>--}}
{{--                    <p>Вопрос “Как похудеть?” волнует многих. Если ты соблюдаешь диету,--}}
{{--                        занимаешься спортом, делаешь вакуум, стоишь в планке и до сих пор не--}}
{{--                        понимаешь, что мешает похудеть, то мы постараемся ответитьо сих пор не--}}
{{--                        понимаешь, что мешает похудеть...</p>--}}
{{--                </div>--}}
{{--                <div class="tape-content-foot">--}}
{{--                    <div class="user-tape">--}}
{{--                        <div class="user-tape-img"--}}
{{--                             style="background-image: url(/img/tape/user.png);"></div>--}}
{{--                        <span>Solnce1988</span>--}}
{{--                    </div>--}}
{{--                    <div class="tape-activity">--}}
{{--                        <div class="tape-activity-el">--}}
{{--                            <img src="/img/tape/like.png" alt="">--}}
{{--                            <span class="tape-activity-el-count">0</span>--}}
{{--                        </div>--}}
{{--                        <div class="tape-activity-el">--}}
{{--                            <img src="/img/tape/bookmark.png" alt="">--}}
{{--                            <span class="tape-activity-el-count">0</span>--}}
{{--                        </div>--}}
{{--                        <div class="tape-activity-el">--}}
{{--                            <img src="/img/tape/comment.png" alt="">--}}
{{--                            <span class="tape-activity-el-count">0</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </article>--}}

{{--        </div>--}}
{{--        <div class="wrap-tapes-column">--}}
{{--            <article class="tape-content ">--}}
{{--                <div class="tape-content-top">--}}
{{--                    <div class="tape-content-btn">--}}
{{--                        <img src="/img/tape/speaker.png" alt="">--}}
{{--                    </div>--}}
{{--                    <div class="tape-content-time">--}}
{{--                        <span>Вчера 18:45</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="tape-content-body">--}}
{{--                    <h4>Нужны ли мужчинам отношения с женщинами?</h4>--}}
{{--                    <p>Вопрос “Как похудеть?” волнует многих. Если ты соблюдаешь диету,--}}
{{--                        занимаешься спортом, делаешь вакуум, стоишь в планке и до сих пор не--}}
{{--                        понимаешь, что мешает похудеть, то мы постараемся ответить до сих пор не--}}
{{--                        понимаешь, что мешает похудеть...</p>--}}
{{--                </div>--}}
{{--                <div class="tape-content-foot">--}}
{{--                    <div class="user-tape">--}}
{{--                        <div class="user-tape-img"--}}
{{--                             style="background-image: url(/img/tape/user.png);"></div>--}}
{{--                        <span>Solnce1988</span>--}}
{{--                    </div>--}}
{{--                    <div class="tape-activity">--}}
{{--                        <div class="tape-activity-el">--}}
{{--                            <img src="/img/tape/like.png" alt="">--}}
{{--                            <span class="tape-activity-el-count">0</span>--}}
{{--                        </div>--}}
{{--                        <div class="tape-activity-el">--}}
{{--                            <img src="/img/tape/bookmark.png" alt="">--}}
{{--                            <span class="tape-activity-el-count">0</span>--}}
{{--                        </div>--}}
{{--                        <div class="tape-activity-el">--}}
{{--                            <img src="/img/tape/comment.png" alt="">--}}
{{--                            <span class="tape-activity-el-count">0</span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </article>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--    <div class="btn-green tapes-else">--}}
{{--        <a href="#">Смотреть еще <img src="/img/tape/else_icon.svg" alt=""></a>--}}
{{--    </div>--}}
{{--</section>--}}
