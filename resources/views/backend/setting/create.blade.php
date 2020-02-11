@extends('backend.layouts.app')

@section('content')
<div class="container">
    <h2>Настроки группы</h2>
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
    {{ Form::open(['route' => 'admin.setting.store', 'method' => 'post']) }}
        @include('backend.setting.partial.form')
    {{ Form::close() }}
</div>
@endsection