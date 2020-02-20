@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2>Редактировать ответ</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{ Form::model($answer, ['route' => ['admin.answer.update', $answer->id], 'method' => 'put']) }}
        <div class="form-group row">
            {{ Form::label('lead_type', 'Тип пользователя', ['class' => 'col-lg-2 col-xs-12 col-form-label']) }}
            <div class="col-lg-4 col-xs-12">
                {{ Form::select('lead_type', $leadTypes, null, [
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>
        {{ Form::label('entry_message', 'Входящее сообщение') }}
        <div class="form-row">
            <div class="form-group col-md-4 col-xs-12">
                {{ Form::select('entry_message_type', $entryMessageTypes, null, [
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="form-group col-md-8 col-xs-12">
                {{ Form::input('text', 'entry_message', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Сообщение от пользователя'
                ]) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('output_message', 'Ответное сообщение') }}
            {{ Form::textarea('output_message', null, [
                'class' => 'form-control',
                'rows' => '3',
                'placeholder' => 'Сообщение для отправки пользователю'
            ]) }}
        </div>
        <div class="form-group">
            {{ Form::checkbox('active', '1', true) }}
            <label class="form-check-label" for="active">
                Активно
            </label>
        </div>
        {{ Form::button('Сохранить', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
    {{ Form::close() }}
</div>
@endsection