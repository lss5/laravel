@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2 class="my-2">Сообщения</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Профиль</th>
                <th scope="col">Сообщение</th>
                <th scope="col">Дата создания</th>
                <th scope="col" class="text-center">DEL</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($messages as $message)
                <tr>
                    <th scope="row">@isset ($message->lead) {{ $message->lead->first_name . ' ' . $message->lead->last_name }} @if ($message->direction == 'in') -> @else <- @endif @endisset</th>
                    <td>{{ $message->text }}</td>
                    <td>{{ $message->created_at }}</td>
                    <td class="text-center text-danger">
                        <form action="{{ route('admin.messages.destroy', ['id' => $message->id]) }}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Нет сообщений</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection