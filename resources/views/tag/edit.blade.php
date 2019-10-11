@extends('layouts.app')
@section('content')
    <div class="settings-content-el">
        <div class="settings-content-el-top unselectable">
            <div class="settings-content-el-left">
                <div class="settings-content-el-left-icon">
                </div>
                <span>Добавить новый</span>
            </div>
            <div class="settings-content-el-right">
                <div class="arr_settigns">
                    <img src="/img/arr_blue.svg" alt="">
                </div>
            </div>
        </div>
        <div class="settings-content-el-body" style="display: none;">
            <form action="{{route('tag-add')}}" method="POST" class="form-settigns-el">
                @csrf
                <div class="inputs">
                    <div class="input-el">
                        <h4>Название</h4>
                        <input name="name" type="text" class="inp-default" value="{{old('name')}}" required>
                    </div>
                    <div class="input-el">
                        <h4>Тег h1</h4>
                        <input name="title" type="text" class="inp-default" value="{{old('title')}}" required>
                    </div>
                    <div class="input-el">
                        <h4>Seo title</h4>
                        <input name="seoTitle" type="text" class="inp-default" value="{{old('seoTitle')}}" required>
                    </div>
                    <div class="input-el">
                        <h4>Seo description</h4>
                        <input name="seoDesc" type="text" class="inp-default" value="{{old('seoDesc')}}" required>
                    </div>
                </div>

                <div class="btn-green">
                    <button type="submit">Сохранить</button>
                </div>
            </form>
        </div>
    </div>

    @foreach($tags as $tag)
        <div class="settings-content-el">
        <div class="settings-content-el-top unselectable">
            <div class="settings-content-el-left">
                <div class="settings-content-el-left-icon">
                </div>
                <span>{{$tag->name}}</span>
            </div>
            <div class="settings-content-el-right">
                <div class="arr_settigns">
                    <img src="/img/arr_blue.svg" alt="">
                </div>
            </div>
        </div>
        <div class="settings-content-el-body" style="display: none;">
            <form action="{{ route('tag-delete', $tag->id) }}" method="POST" style="margin-bottom: 30px">
                @csrf
                <span class="btn-green delete-tag">
                    <button type="submit">Удалить</button>
                </span>
            </form>
            <form action="{{route('edit-tag', $tag->id)}}" method="POST" class="form-settigns-el">
                @csrf
                <div class="inputs">
                    <div class="input-el">
                        <h4>Название</h4>
                        <input name="name" type="text" class="inp-default" value="{{$tag->name}}" required>
                    </div>
                    <div class="input-el">
                        <h4>Тег h1</h4>
                        <input name="title" type="text" class="inp-default" value="{{$tag->title}}" required>
                    </div>
                    <div class="input-el">
                        <h4>Seo title</h4>
                        <input name="seoTitle" type="text" class="inp-default" value="{{$tag->seoTitle}}" required>
                    </div>
                    <div class="input-el">
                        <h4>Seo description</h4>
                        <input name="seoDesc" type="text" class="inp-default" value="{{$tag->seoDesc}}" required>
                    </div>
                </div>

                <div class="btn-green">
                    <button type="submit">Сохранить</button>
                </div>
            </form>
        </div>
    </div>
    @endforeach
@endsection
