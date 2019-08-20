@extends('backend.layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('admin.setting.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
        <label for="url_callback">URL Callback для бота</label>
        <div class="input-group" id="url_callback">
            <div class="input-group-prepend">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Действие</button>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" onclick="document.getElementById('url_callback_bot').value = '{{ url('') }}'">Вставить URL</a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Отправить url</a>
                    <a class="dropdown-item" href="#">Получить информацию</a>
                </div>
            </div>
            <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot" value="{{ isset($url_callback_bot) ? $url_callback_bot : '' }}">
        </div>
        <button type="submit" class="btn btn-primary mt-4">Сохранить</button>
    </div>

    </form>
</div>
@endsection