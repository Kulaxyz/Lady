@extends('layouts/app')

@section('content')
    @if($errors)
        @foreach ($errors->all() as $error)
            <div><h2 style="color: red">{{ $error }}</h2></div>
        @endforeach
    @endif



    <section class="sec-publication">
        <div class="wrap-publication">
            <h2>Публикация</h2>
            <div class="wrap-publication-content">
                <div class="publication-content-form">
                    <form action="{{ route('store-post') }}" method="post" id="addPost" enctype="multipart/form-data">
                        @csrf
                        <div class="publication-content-form-el">
                            <h4>Название</h4>
                            <div class="inputs">
                                <input minlength="2" maxlength="75" name="title" value="{{ old('title') }}" type="text">
                            </div>
                        </div>
                        <div class="publication-content-form-el">
                            <h4>Текст</h4>
                            <div class="textarea">
                                <textarea minlength="5" maxlength="2000" name="description">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <add-field></add-field>
                        <div class="publication-content-form-el">
                            <h4>Тема</h4>
                            <div class="select">
                                <select required class="select_jq" name="tags[]" data-placeholder=" " multiple>
                                    @foreach($tags as $tag)
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="publication-content-form-bottom" style="margin-bottom: 20px">
                            <div style="margin-bottom:-35px">
                            <img-upload></img-upload>

                            <div class="wrap-checkbox unselectable anon-check">
                                <label>
                                    <div class="checkbox-el">
                                        <input type="checkbox" name="anon">
                                        <div class="checkbox"></div>
                                    </div>
                                    <span>Анонимно</span>
                                </label>
                            </div>
                            </div>

                            <div class="publication-content-form-btn btn-green">
                                <button type="submit">Опубликовать</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



{{--    </div>--}}
{{--    </div>--}}
{{--    --}}{{--                    <div class="sample" style="display: none">--}}
{{--    --}}{{--                        <div class="form-group">--}}
{{--    --}}{{--                            <label>Добавить вариант ответа</label>--}}
{{--    --}}{{--                            <input type="button"--}}
{{--    --}}{{--                                   class="btn btn-primary"--}}
{{--    --}}{{--                                   value="+"--}}
{{--    --}}{{--                                   @click="addGuest"--}}
{{--    --}}{{--                            >--}}
{{--    --}}{{--                        </div>--}}
{{--    --}}{{--                        <div>--}}
{{--    --}}{{--                            <div class="form-group" v-for="(guest, index) in guests">--}}
{{--    --}}{{--                                <label @dblclick="deleteGuest(index)">--}}
{{--    --}}{{--                                    Вариант @{{ index + 1 }}--}}
{{--    --}}{{--                                </label>--}}
{{--    --}}{{--                                <input type="text" name="options[]" class="form-control" v-model="guests[index]">--}}
{{--    --}}{{--                            </div>--}}
{{--    --}}{{--                        </div>--}}
{{--    --}}{{--                    </div>--}}
{{--    </form>--}}
{{--    </div>--}}

@endsection
@section('scripts')
    {{--    <script src="//cdnjs.cloudflare.com/ajax/libs/masonry/4.1.1/masonry.pkgd.min.js"></script>--}}
    {{--    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/4.1.1/imagesloaded.pkgd.min.js"></script>--}}
    {{--    <script src="//cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>--}}
    {{--<script>--}}
    {{--    $( document ).ready(function() {--}}

    {{--        new Vue({--}}
    {{--            el: '.sample',--}}
    {{--            data: {--}}
    {{--                guests: []--}}
    {{--            },--}}
    {{--            methods: {--}}
    {{--                addGuest() {--}}
    {{--                    this.guests.push('');--}}
    {{--                },--}}
    {{--                deleteGuest(index) {--}}
    {{--                    this.guests.splice(index, 1);--}}
    {{--                }--}}
    {{--            }--}}
    {{--        })--}}
    {{--    });--}}
    {{--</script>--}}



@endsection
