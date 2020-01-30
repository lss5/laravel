@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2 class="py-2">Профили</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" width="20%">Профиль</th>
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
                    <td>@if ($lead->lastMessage['direction'] == 'out')
                            <i class="fas fa-arrow-circle-left"></i> {{$lead->lastMessage['direction']}}
                        @elseif ($lead->lastMessage['direction'] == 'in')
                        <i class="fas fa-arrow-circle-right"></i> {{$lead->lastMessage['direction']}}
                    @endif</td>
                    <td>{{ $lead->lastMessage['text'] }}</td>
                    <td class="text-center text-primary">
                        <a href="{{ route('admin.message.create', ['lead_id' => $lead->id]) }}">
                            <i class="fas fa-paper-plane"></i>
                        </a>
                    </td>
                    <td class="text-center text-danger">
                        <form action="{{ route('admin.lead.destroy', ['id' => $lead->id]) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="tt-icon-btn tt-hover-02 tt-small-indent">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
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