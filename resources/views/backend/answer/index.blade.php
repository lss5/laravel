@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <h1>Ответы</h1>
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
        <div class="form-group">
            <a href="{{ route('admin.answer.create') }}" class="btn btn-success" role="button">Создать ответ</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="5%">Тип пользователей</th>
                    <th scope="col" width="5%">Тип сообщения</th>
                    <th scope="col" width="15%">Сообщение</th>
                    <th scope="col" width="50%" class="text-center">Ответ</th>
                    <th scope="col" width="5%" class="text-center">DEL</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($answers as $answer)
                <tr>
                    <td>{{ $answer->lead_type }}</td>
                    <td>{{ $answer->entry_message_type }}</td>
                    <td>{{ $answer->entry_message }}</td>
                    <td>{{ $answer->output_message }}</td>
                    <td class="text-center text-danger">
                        {{ Form::open(['route' => ['admin.answer.destroy', $answer->id], 'method' => 'delete']) }}
                            {{ Form::button('<i class="fas fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger',
                                'onclick'=>'return confirm("Удалить ?")',
                            ]) }}
                        {{ Form::close() }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection