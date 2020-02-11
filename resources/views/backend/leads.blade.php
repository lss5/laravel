@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2 class="py-2">Профили</h2>
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
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="15%">Профиль</th>
                <th scope="col" width="15%">Группа</th>
                <th scope="col" width="5%">Направление</th>
                <th scope="col">Последнее сообщение</th>
                <th scope="col" width="5%" class="text-center">MES</th>
                <th scope="col" width="5%" class="text-center">DEL</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leads as $lead)
                <tr>
                    <td>{{ $lead->first_name . ' ' . $lead->last_name }} ({{ $lead->id }})</td>
                    <td>{{ $lead->group_id }}</td>
                    <td>@if ($lead->lastMessage['direction'] == 'out')
                            <i class="fas fa-arrow-circle-left"></i> {{$lead->lastMessage['direction']}}
                        @elseif ($lead->lastMessage['direction'] == 'in')
                        <i class="fas fa-arrow-circle-right"></i> {{$lead->lastMessage['direction']}}
                    @endif</td>
                    <td>{{ $lead->lastMessage['text'] }}</td>
                    <td class="text-center text-primary">
                        <a href="{{ route('admin.message.create', ['lead_id' => $lead->id]) }}">
                            <button type="button" class="btn btn-primary"><i class="fas fa-paper-plane"></i></button>
                        </a>
                    </td>
                    <td class="text-center text-danger">
                        {{ Form::open(['route' => ['admin.lead.destroy', $lead->id], 'method' => 'delete']) }}
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
                    <td colspan="5">Нет заявок</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection