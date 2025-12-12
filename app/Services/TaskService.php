<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskService
{
    public function getUserTasks()
    {
        return Task::where('user_id', Auth::id())->get();
    }

    public function getTask($id)
    {
        return Task::where('user_id', Auth::id())->findOrFail($id);
    }

    public function createTask(array $data)
    {
        return Task::create([
            'user_id' => Auth::id(),
            ...$data
        ]);
    }

    public function updateTask($id, array $data)
    {
        $task = $this->getTask($id);
        $task->update($data);
        return $task;
    }

    public function deleteTask($id)
    {
        $task = $this->getTask($id);
        return $task->delete();
    }
}
