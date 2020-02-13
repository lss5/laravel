@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2 class="py-2">Подключенные группы</h2>
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
        <a href="{{ route('admin.setting.create') }}">
            <button type="button" class="btn btn-primary">Добавить группу</button>
        </a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="30%">Название</th>
                <th scope="col" width="20%">Дата добавления</th>
                <th scope="col" width="10%" class="text-center">EDIT</th>
                <th scope="col" width="10%" class="text-center">DEL</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($settings as $setting)
                <tr>
                    <td>{{ $setting->name }} ({{ $setting->vk_id_group }})</td>
                    <td>{{ $setting->created_at->format('d-m-Y h:i') }}</td>
                    <td class="text-center text-primary">
                        <a href="{{ route('admin.setting.edit', ['id' => $setting->id]) }}">
                            <button type="button" class="btn btn-primary"><i class="fas fa-edit"></i></button>
                        </a>
                    </td>
                    <td class="text-center text-danger">
                        {{ Form::open(['route' => ['admin.setting.destroy', $setting->id], 'method' => 'delete']) }}
                            {{ Form::button('<i class="fas fa-trash"></i>', [
                                'type' => 'submit',
                                'class' => 'btn btn-danger',
                                'onclick'=>'return confirm("Удалить ?")',
                            ]) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Нет заявок</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection