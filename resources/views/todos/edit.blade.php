@extends('layouts.app')

@section('title', 'Todo 編集')

@section('content')
    <h1 class="h3 mb-3">Todo を編集</h1>

    <form action="{{ route('todos.update', $todo) }}" method="POST">
        @csrf
        @method('PUT')

        @include('todos.form')

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">更新</button>
            <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary">戻る</a>
        </div>
    </form>
@endsection
