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
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        {{ Form::open(['route' => 'admin.notification.create', 'method' => 'post']) }}
            <div class="form-group row">
                {{ Form::label('group', 'Группа', ['class' => 'col-lg-1 col-xs-12 col-form-label']) }}
                <div class="col-lg-4 col-xs-12">
                {{ Form::select('group', $groups, null, [
                        'class' => 'form-control',
                    ]) }}
                </div>
            </div>
            {{ Form::button('Собрать базу',[
                'type' => 'submit',
                'class' => 'btn btn-success col-lg-5',
            ]) }}
            <small id="emailHelp" class="form-text text-muted">Для отправки сообщений необходимо собрать базу пользователей подписанных на ваше сообщество</small>
        {{ Form::close() }}
    </div>
    <div class="container mt-3">
        <h2>Последние рассылки</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="10%">Дата рассылки</th>
                    <th scope="col">Последнее сообщение</th>
                    <th scope="col" width="5%">Кол-во пользователей</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($notifications as $notification)
                    <tr>
                        <td>{{ $notification->created_at->format('d-m-Y h:m') }}</td>
                        <td>{{ $notification->message }}</td>
                        <td>{{ $notification->count }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Нет рассылок</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $notifications->links() }}
    </div>
@endsection