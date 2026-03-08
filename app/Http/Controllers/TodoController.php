<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use App\Services\TodoDeadlineService;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function __construct(
        private readonly TodoDeadlineService $todoDeadlineService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // with() でユーザーを先読み
        $todos = Todo::with('user')
            ->orderBy('due_date')
            ->orderBy('priority')
            ->get();

        $todos->each(function (Todo $todo): void {
            $todo->setAttribute('is_overdue', $this->todoDeadlineService->isOverdue($todo));
        });

        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $todo = new Todo();

        return view('todos.create', compact('users', 'todo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,done'],
            'priority' => ['required', 'integer', 'between:1,5'],
            'due_date' => ['nullable', 'date'],
        ]);

        Todo::create($data);

        return redirect()->route('todos.index')->with('success', 'Todo を作成しました。');
    }

    /**
     * Display the specified resource.
     */
    public function show(Todo $todo)
    {
        return redirect()->route('todos.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Todo $todo)
    {
        $users = User::all();

        return view('todos.edit', compact('todo', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
            'status' => ['required', 'in:pending,in_progress,done'],
            'priority' => ['required', 'integer', 'between:1,5'],
            'due_date' => ['nullable', 'date'],
        ]);

        $todo->update($data);

        return redirect()->route('todos.index')->with('success', 'Todo を更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo を削除しました。');
    }
}
