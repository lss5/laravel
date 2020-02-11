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
            {{ Form::label('group', 'Группа', ['class' => 'col-lg-1 col-xs-12 col-form-label']) }}
            <div class="col-lg-4 col-xs-12">
                {{ Form::select('group', [
                        '1' => '1',
                        '2' => '3',
                        '3' => '3'
                    ], '2', [
                    'class' => 'form-control',
                ]) }}
            </div>
            {{ Form::label('leadType', 'Тип пользователя', ['class' => 'col-lg-2 col-xs-12 col-form-label']) }}
            <div class="col-lg-4 col-xs-12">
                {{ Form::select('leadType', [
                        'new' => 'Новый',
                        'exist' => 'Существующий',
                        'any' => 'Любой'
                    ], 'any', [
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>
        {{ Form::label('message', 'Входящее сообщение') }}
        <div class="form-row">
            <div class="form-group col-md-4 col-xs-12">
                {{ Form::select('typeEntryMessage', [
                        'exactly' => 'Точное совпадение',
                        'exist' => 'Содержит',
                        'all' => 'Любое',
                    ], 'exist', [
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="form-group col-md-8 col-xs-12">
                {{ Form::input('text', 'message', null, [
                    'class' => 'form-control',
                    'placeholder' => 'Сообщение от пользователя'
                ]) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('answer', 'Ответное сообщение') }}
            {{ Form::textarea('answer', null, [
                'class' => 'form-control',
                'rows' => '3',
                'placeholder' => 'Сообщение для отправки пользователю'
            ]) }}
        </div>
        {{ Form::button('Сохранить', ['class' => 'btn btn-primary', 'type' => 'submit']) }}
    {{ Form::close() }}
</div>
@endsection