@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2 class="py-2">Профили</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Профиль</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Дата создания</th>
                <th scope="col" class="text-center">MES</th>
                <th scope="col" class="text-center">DEL</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leads as $lead)
                <tr>
                    {{-- <th scope="row">{{ $lead->first_name . ' ' . $lead->last_name }} ({{ $lead->id }})</th> --}}
                    <td>{{ $lead->first_name . ' ' . $lead->last_name }} ({{ $lead->id }})</td>
                    <td>
                    @forelse ($lead->messages as $message)
                        {{ $message->text }}<br>
                    @empty
                        Нет сообщений
                    @endforelse
                    </td>
                    <td>{{ $lead->created_at }}</td>
                    <td class="text-center text-primary"><a href="{{ route('admin.messages.create', ['lead_id' => $lead->id]) }}"><i class="fas fa-paper-plane"></i></a></td>
                    <td class="text-center text-danger"><i class="fas fa-trash"></i></td>
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