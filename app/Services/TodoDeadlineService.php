<?php

namespace App\Services;

use App\Models\Todo;

class TodoDeadlineService
{
    /**
     * 期限日が過ぎていて未完了なら期限切れとする。
     */
    public function isOverdue(Todo $todo): bool
    {
        if (! $todo->due_date) {
            return false;
        }

        return $todo->status !== 'done' && $todo->due_date->isPast();
    }
}
