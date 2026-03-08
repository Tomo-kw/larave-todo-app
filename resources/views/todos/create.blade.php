@extends('layouts.app')

@section('title', 'Todo 作成')

@section('content')
    <h1 class="h3 mb-3">新しい Todo を作成</h1>

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf

        @include('todos.form')

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">作成</button>
            <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary">戻る</a>
        </div>
    </form>
@endsection
