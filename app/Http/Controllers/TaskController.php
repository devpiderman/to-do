<?php

namespace App\Http\Controllers;

use App\Events\LogEvent;
use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskCollection;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = auth()->user()->tasks()->filter($request->all())->paginate();
        return new TaskCollection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        (new TaskService)->create($request->input('folder_id'));
        $task = auth()->user()->tasks()->create($request->validated());
        event(new LogEvent($task, __FUNCTION__));
        return response()->json([
            'message' => 'Task Created Successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        Gate::authorize('view', $task);
        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        (new TaskService)->update($request->input('folder_id'));
        Gate::authorize('update', $task);
        $task->update($request->validated());
        event(new LogEvent($task, __FUNCTION__));
        return response()->json([
            'message' => 'Task Updated Successfully',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);
        $task->delete();
        event(new LogEvent($task, __FUNCTION__));
        return response()->json([
            'message' => 'Task Deleted Successfully',
        ], 204);
    }
}
