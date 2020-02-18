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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <div class="form-group">
            <a href="{{ route('admin.answer.create') }}" class="btn btn-success" role="button">Создать ответ</a>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col" width="5%">Тип пользователей</th>
                    <th scope="col" colspan="2" width="15%">Входящее сообщение</th>
                    <th scope="col" width="50%" class="text-center">Ответ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($answers as $answer)
                    <td>{{ $answer->lead_type }}</td>
                    <td>{{ $answer->entry_message_type }}</td>
                    <td>{{ $answer->entry_message }}</td>
                    <td>{{ $answer->output_message }}</td>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection