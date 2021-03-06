<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Task;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        return TaskResource::collection(auth()->user()->tasks()->with('creator')->latest()->paginate(50));
    }
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
        ]);
        $input = $request->all();
        if ($request->has('due')) {
            $input['due'] = carbon::parse($request->due)->toDateTimeString();

        }
        $task = auth()->user()->tasks()->create($input);
        return new TaskResource($task->load('creator'));
    }
    public function show(Task $task)
    {
        return new TaskResource($task->load('creator'));
    }
    public function update(Request $request, Task $task)
    {$request->validate([
        'title' => 'required|max:255',
    ]);
        $input = $request->all();
        if ($request->has('due')) {
            $input['due'] = carbon::parse($request->due)->toDateTimeString();

        }
        $task->update($input);
        return new TaskResource($task->load('creator'));

    }
    public function destroy(Task $task)
    {$task ->delete();
        return response(['message' => 'deleted']);

    }
}
