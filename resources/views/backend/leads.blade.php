@extends('backend.layouts.app')

@section('content')
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leads as $lead)
                <tr>
                    <th scope="row">{{ $lead->id }}</th>
                    <td>{{ $lead->first_name . ' ' . $lead->last_name }}</td>
                    <td>
                    @forelse ($lead->messages as $message)
                        {{ $message->text }}<br>
                    @empty
                        Нет сообщений
                    @endforelse
                    </td>
                    <td>{{ $lead->created_at }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Нет заявок</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection