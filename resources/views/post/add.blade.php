@extends('layouts/app')

@section('content')
            <example-component>
            </example-component>
        @if($errors)
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                <h1 class="page-header">Add new Article</h1>

                <form action="{{ route('store-post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" value="{{old('title')}}" name="title" class="form-control" id="title" placeholder="Title">
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-7 col-md-9">
                            <div class="form-group">
                                <textarea class="form-control" name="description" id="content">{{old('description')}}</textarea>
                            </div>
                        </div>
                        <div class="col-xs-5 col-md-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-default">Preview</button>
                                <button type="submit" class="btn btn-primary">Publish</button>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Темы</label>
                                    <select name="tags[]" class="selectpicker" multiple data-size="5" data-live-search="true" data-actions-box="true">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                    @endforeach
                                </select>





                            </div>
                            <div class="form-group">
                                <label for="type_id">Выберите тип</label>
                                    <div class="custom-radio">
                                        <label>
                                            <input name="type" type="radio" value="post" checked>
                                            Пост
                                        </label>
                                    </div>
                                    <div class="custom-radio">
                                        <label>
                                            <input name="type" type="radio" value="vote">
                                            Опрос
                                        </label>
                                    </div>
                                <div class="custom-radio">
                                        <label>
                                            <input name="type" type="radio" value="question">
                                            Вопрос
                                        </label>
                                    </div>
                            </div>
                            <div class="form-group">
                                <input id="anon" name="is_anonimous" type="checkbox" value="1">
                                <label for="anon">Анонимный вопрос</label>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="files">Добавить фото</label>
                            <input type="file" id="files" multiple="multiple" name="files[]" style="visibility: hidden" />
                            <ul id="list"></ul>
                    </div>
                    <add-field></add-field>
{{--                    <div class="sample" style="display: none">--}}
{{--                        <div class="form-group">--}}
{{--                            <label>Добавить вариант ответа</label>--}}
{{--                            <input type="button"--}}
{{--                                   class="btn btn-primary"--}}
{{--                                   value="+"--}}
{{--                                   @click="addGuest"--}}
{{--                            >--}}
{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <div class="form-group" v-for="(guest, index) in guests">--}}
{{--                                <label @dblclick="deleteGuest(index)">--}}
{{--                                    Вариант @{{ index + 1 }}--}}
{{--                                </label>--}}
{{--                                <input type="text" name="options[]" class="form-control" v-model="guests[index]">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </form>
            </div>

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


    $( document ).ready(function() {
        $('input:radio[name="type"]').change(
            function(){
                if ($(this).is(':checked') && this.value == 'vote') {
                    $('.sample').show();
                }
                else {
                    $('.sample').hide();
                    resetAllValues();
                }
            });
    });

    function showFile(e) {
            var files = e.target.files;
            for (var i = 0, f; f = files[i]; i++) {
                if (!f.type.match('image.*')) continue;
                var fr = new FileReader();
                fr.onload = (function(theFile) {
                    return function(e) {
                        var li = document.createElement('li');
                        li.innerHTML = "<img src='" + e.target.result + "' />";
                        document.getElementById('list').insertBefore(li, null);
                    };
                })(f);
                fr.readAsDataURL(f);
            }
        }
        document.addEventListener('DOMContentLoaded', function(){
            document.getElementById('files').addEventListener('change', showFile, false);
        })
    </script>


@endsection
