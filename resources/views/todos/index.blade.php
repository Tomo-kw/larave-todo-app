@extends('layouts.app')

@section('title', 'Todo 一覧')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3">Todo 一覧</h1>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">新規作成</a>
    </div>

    @if($todos->isEmpty())
        <div class="alert alert-secondary">まだ Todo がありません。</div>
    @else
        <div class="table-responsive">
            <table class="table table-sm table-bordered align-middle">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>タイトル</th>
                    <th>ユーザー</th>
                    <th>状態</th>
                    <th>優先度</th>
                    <th>期限</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($todos as $todo)
                    <tr>
                        <td>{{ $todo->id }}</td>
                        <td>{{ $todo->title }}</td>
                        <td>{{ $todo->user->name ?? '-' }}</td>
                        <td>{{ $todo->status }}</td>
                        <td>{{ $todo->priority }}</td>
                        <td>{{ $todo->due_date?->format('Y-m-d') ?? '-' }}</td>
                        <td>
                            <a href="{{ route('todos.edit', $todo) }}" class="btn btn-sm btn-outline-secondary">編集</a>
                            <form action="{{ route('todos.destroy', $todo) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('削除してもよろしいですか？')">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
