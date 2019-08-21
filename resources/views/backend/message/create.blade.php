@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2>Отправить сообщение</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.messages.store') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="lead">Профиль</label>
            <input type="text" class="form-control" id="lead" name="lead" aria-describedby="emailHelp" placeholder="ID пользователя (пока так)">
            {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
        </div>
        <div class="form-group">
            <label for="text">Текст сообщения</label>
            <textarea class="form-control" id="text" name="text" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
            {{-- <input type="url" class="form-control" id="url_callback_bot" name="url_callback_bot" value="{{ isset($url_callback_bot) ? $url_callback_bot : '' }}"> --}}
        {{-- <button type="submit" class="btn btn-primary mt-4">Сохранить</button> --}}
    </div>

    </form>
</div>
@endsection