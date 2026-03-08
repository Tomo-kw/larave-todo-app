<?php

namespace App\Http\Middleware;

use App\Models\Todo;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTodoOwner
{
    /**
     * Todo の所有者のみ編集・更新・削除を許可する。
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $todoParam = $request->route('todo');

        if (! $user) {
            abort(403);
        }

        $todo = $todoParam instanceof Todo ? $todoParam : Todo::find($todoParam);

        if (! $todo || (int) $todo->user_id !== (int) $user->id) {
            abort(403);
        }

        return $next($request);
    }
}
