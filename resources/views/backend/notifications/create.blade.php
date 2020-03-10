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
            <div class="form-group">
                <h5>Отписались от сообщений<span class="badge badge-success">{{ $count_leads_updated }}</span></h5>
                <h5>Доступно для отправки<span class="badge badge-success">{{ $count_leads }}</span></h5>
            </div>
            <div class="form-group">
                {{ Form::label('message', 'Сообщение') }}
                {{ Form::textarea('message', '', [
                    'class' => 'form-control',
                    'aria-label' => 'Сообщение',
                    'placeholder' => 'Введите ваше сообщение',
                    'rows' => '10'
                ]) }}
                <small class="form-text text-muted">Доступные переменные: {FIRST_NAME} - Имя.</small>
                <small class="form-text text-muted">Необходимо сохранять регистр переменных.</small>
            </div>
            {{ Form::submit('Отправить', ['class' => 'btn btn-success']) }}
        {{ Form::close() }}
    </div>
@endsection