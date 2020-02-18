@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2>Создать ответ</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::open(['route' => 'admin.answer.store', 'method' => 'post']) }}
        <div class="form-group row">
            {{ Form::label('leadType', 'Тип пользователя', ['class' => 'col-lg-2 col-xs-12 col-form-label']) }}
            <div class="col-lg-4 col-xs-12">
                {{ Form::select('leadType', $leadTypes, $leadTypeDefault, [
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>
        {{ Form::label('entryMessage', 'Входящее сообщение') }}
        <div class="form-row">
            <div class="form-group col-md-4 col-xs-12">
                {{ Form::select('entryMessageType', $entryMessageTypes, $entryMessageTypeDefault, [
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="form-group col-md-8 col-xs-12">
                {{ Form::input('text', 'entryMessage', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Сообщение от пользователя'
                ]) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('outputMessage', 'Ответное сообщение') }}
            {{ Form::textarea('outputMessage', null, [
                'class' => 'form-control',
                'rows' => '3',
                'placeholder' => 'Сообщение для отправки пользователю'
            ]) }}
        </div>
        {{ Form::button('Сохранить', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
    {{ Form::close() }}
</div>
@endsection