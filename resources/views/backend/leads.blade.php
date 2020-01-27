@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2 class="py-2">Профили</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="25%">Профиль</th>
                <th scope="col">Сообщение</th>
                <th scope="col" width="5%" class="text-center">MES</th>
                <th scope="col" width="5%" class="text-center">DEL</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leads as $lead)
                <tr>
                    <td>{{ $lead->first_name . ' ' . $lead->last_name }} ({{ $lead->id }})</td>
                    <td><table>
                        @forelse ($lead->messages as $message)
                            <tr>
                                <td>@if ($message->direction == 'out') <i class="fas fa-arrow-circle-left"></i> @elseif ($message->direction == 'in') <i class="fas fa-arrow-alt-circle-right"></i> @endif</td>
                                <td>{{ $message->text }}</td>
                                <td>{{ $message->created_at->format('d/m/Y H:s') }}</td>
                            </tr>
                        @empty
                            Нет сообщений
                        @endforelse
                    </table></td>
                    <td class="text-center text-primary">
                        <a href="{{ route('admin.message.create', ['lead_id' => $lead->id]) }}">
                            <i class="fas fa-paper-plane"></i>
                        </a>
                    </td>
                    <td class="text-center text-danger">
                        <i class="fas fa-trash"></i>
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