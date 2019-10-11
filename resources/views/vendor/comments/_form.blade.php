<div class="card">
    <div class="card-body">
        @if($errors->has('commentable_type'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->get('commentable_type') }}
            </div>
        @endif
        @if($errors->has('commentable_id'))
            <div class="alert alert-danger" role="alert">
                {{ $errors->get('commentable_id') }}
            </div>
        @endif
        <form id="fcomment" method="POST" action="{{ url('comments') }}">
            @csrf
            <input type="hidden" name="commentable_type" value="\{{ get_class($model) }}" />
            <input type="hidden" name="commentable_id" value="{{ $model->id }}" />

{{--            --}}{{-- Guest commenting --}}
{{--            @if(isset($guest_commenting) and $guest_commenting == true)--}}
{{--                <div class="form-group">--}}
{{--                    <label for="message">Введите ваше имя:</label>--}}
{{--                    <input type="text" class="form-control @if($errors->has('guest_name')) is-invalid @endif" name="guest_name" />--}}
{{--                    @error('guest_name')--}}
{{--                        <div class="invalid-feedback">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <label for="message">Веедите ваш email:</label>--}}
{{--                    <input type="email" class="form-control @if($errors->has('guest_email')) is-invalid @endif" name="guest_email" />--}}
{{--                    @error('guest_email')--}}
{{--                        <div class="invalid-feedback">--}}
{{--                            {{ $message }}--}}
{{--                        </div>--}}
{{--                    @enderror--}}
{{--                </div>--}}
{{--            @endif--}}


            <div class="detail-content-comments-add">
                <div class="textarea-block">
                    <textarea name="message" class="textarea-block__textarea" data-emojiable="true" placeholder="Напишите сообщение"></textarea>
                    <div class="textarea-block-media">
                        <div class="textarea-block-media_el">
                            <div class="load_media">
                                <label class="unselectable">
                                    <input type="file">
                                    <img src="/img/camera.svg" alt="">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
{{--                <div class="wrap-checkbox unselectable anon-check">--}}
{{--                    <label>--}}
{{--                        <div class="checkbox-el">--}}
{{--                            <input type="checkbox" name="anon">--}}
{{--                            <div class="checkbox"></div>--}}
{{--                        </div>--}}
{{--                        <span>Анонимно</span>--}}
{{--                    </label>--}}
{{--                </div>--}}
                <div class="btn-green">
                    <a onclick="$('#fcomment').submit()" >Отправить</a>
                </div>
            </div>
{{--            <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">Отправить</button>--}}
        </form>
    </div>
</div>
<br />
