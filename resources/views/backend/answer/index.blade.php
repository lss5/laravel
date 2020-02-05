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
        <a href="{{ route('admin.answer.create') }}" class="btn btn-success" role="button">Создать ответ</a>
    </div>
@endsection