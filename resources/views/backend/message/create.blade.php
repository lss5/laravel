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
    {{ Form::open(array('route' => 'admin.messages.store', 'method' => 'post')) }}
        <div class="form-group">
            {{ Form::label('lead', 'Профиль') }}
            {{-- {{ $lead }} --}}
            @if (empty($lead))
                {{ Form::text('lead', null, ['class' => 'form-control', 'placeholder' => 'ID пользователя (пока так)']) }}
            @else
                {{ Form::text('lead', $lead, ['class' => 'form-control', 'placeholder' => 'ID пользователя (пока так)', 'readonly']) }}
            @endif
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