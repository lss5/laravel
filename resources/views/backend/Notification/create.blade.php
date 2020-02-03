@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>Рассылка сообщений</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
    <div class="container">
        {{ Form::open(['route' => 'admin.notification.store', 'method' => 'post']) }}
            <div class="form-group sm-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Количество пользователей</span>
                    </div>
                    {{ Form::number('count_users', $count_users, ['readonly' => true, 'class' => 'form-control']) }}
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Сообщение</span>
                    </div>
                    {{ Form::textarea('message', '', [
                        'class' => 'form-control',
                        'aria-label' => 'Сообщение',
                        'placeholder' => 'Введите ваше сообщение',
                        'rows' => '4'
                    ]) }}
                </div>
            </div>
            {{ Form::submit('Отправить', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>
@endsection