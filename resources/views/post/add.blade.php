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
                    <form action="{{ route('store-post') }}" method="post" enctype="multipart/form-data">
                        @csrf
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
                        <div class="publication-content-form-el" onclick="$('#add').slideToggle()">
                            <h4 class="unselectable">Добавить опрос? <span>(нажмите для создания опроса)</span></h4>
                        </div>
                        <add-field></add-field>
                        <div class="publication-content-form-bottom">
{{--                            <div class="add_media">--}}
{{--                                <label for="files" class="unselectable">--}}
{{--                                    <ul id="list">--}}

{{--                                    </ul>--}}
{{--                                    <div class="add_media-content">--}}
{{--                                        <div class="add_media-icon">--}}
{{--                                            <img src="/img/camera.png" alt="">--}}
{{--                                        </div>--}}
{{--                                        <span>Добавить фото</span>--}}
{{--                                    </div>--}}
{{--                                </label>--}}
{{--                                <input type="file" id="files" multiple="multiple" name="files[]"/>--}}

{{--                            </div>--}}

                            <div class="wrap-checkbox unselectable anon-check">
                                <label>
                                    <div class="checkbox-el">
                                        <input type="checkbox" name="anon">
                                        <div class="checkbox"></div>
                                    </div>
                                    <span>Анонимно</span>
                                </label>
                            </div>


                            <div class="publication-content-form-btn btn-green">
                                <button type="submit">Опубликовать</button>
                            </div>
                        </div>
{{--                        <div class="form-group">--}}
{{--                            <label for="files">Добавить фото</label>--}}
{{--                            <input type="file" id="files" multiple="multiple" name="files[]" style="visibility: hidden" />--}}
{{--                            <ul id="list"></ul>--}}
{{--                        </div>--}}
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


    <script type="text/javascript">
        function resetAllValues() {
            $('.sample').find('input:text').val('');
        }


        $(document).ready(function () {
            $('input:radio[name="type"]').change(
                function () {
                    if ($(this).is(':checked') && this.value == 'vote') {
                        $('.sample').show();
                    } else {
                        $('.sample').hide();
                        resetAllValues();
                    }
                });
        });

        function showFile(e) {
            console.log(1);
            var files = e.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) continue;
                var fr = new FileReader();
                fr.onload = (function (theFile) {
                    return function (e) {
                        var li = document.createElement('li');
                        li.innerHTML = "<img src='" + e.target.result + "' />";
                        document.getElementById('list').insertBefore(li, null);
                    };
                })(f);
                fr.readAsDataURL(f);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('files').addEventListener('change', showFile, false);
        })
    </script>


@endsection
