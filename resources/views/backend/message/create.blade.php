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
    {{ Form::open(['route' => 'admin.message.send', 'method' => 'post']) }}
        {{ Form::hidden('lead_id', $lead_id) }}
        <div class="form-group">
            {{ Form::label('lead', 'Профиль') }}
            {{ Form::text('lead', $lead_name, ['class' => 'form-control', 'placeholder' => 'Пользователь', 'readonly']) }}
        </div>
        <div class="form-group">
            {{ Form::label('text', 'Текст сообщения') }}
            {{ Form::textarea('text', null, ['class' => 'form-control', 'rows' => '3']) }}
        </div>
        {{ Form::button('Отправить', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
    </div>
    {{ Form::close() }}
</div>
@endsection