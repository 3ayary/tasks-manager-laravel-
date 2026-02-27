<?php

namespace App\Http\Controllers;

use App\Http\Requests\createTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function getAllTasks()
    {
        return response()->json(Task::all(), 200);
    }

    public function createTask(createTaskRequest $createTaskRequest)
    {

        $task = Task::create(
            $createTaskRequest->validated()
        );

        return response()->json($task, 201);
    }

    public function updateTask(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->update(
            $request->validate([
                'title' => 'sometimes|string|max:40',
                'description' => 'sometimes|string|max:80',
                'priority' => 'sometimes|integer|min:1|max:5',
            ])
        );

        return response()->json($task, 200);
    }

    public function findOne($id)
    {
        return response()->json(Task::findOrFail($id), 200);
    }

    public function deleteTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    }

    public function getTaskUser($id)
    {

        $user = Task::findOrFail($id)->user;

        return response()->json($user,200);

    }
}
