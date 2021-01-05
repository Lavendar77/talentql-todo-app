<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Task\DeleteRequest;
use App\Http\Requests\User\Task\ShowRequest;
use App\Http\Requests\User\Task\StoreRequest;
use App\Http\Requests\User\Task\UpdateRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    private Task $task;

    /**
     * @param Task $task
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $tasks = $request->user()->tasks;

        return response()->json([
            'status' => true,
            'message' => 'Tasks fetched successfully.',
            'data' => [
                'tasks' => $tasks
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $task = new $this->task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->user()->associate($request->user());
        $task->save();

        return response()->json([
            'status' => true,
            'message' => 'Task created successfully.',
            'data' => [
                'task' => $task
            ]
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(ShowRequest $request, Task $task)
    {
        return response()->json([
            'status' => true,
            'message' => 'Task fetched successfully.',
            'data' => [
                'task' => $task
            ]
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Task $task
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateRequest $request, Task $task)
    {
        $task->title = $request->title ?? $task->title;
        $task->description = $request->description ?? $task->description;
        $task->status = $request->status ?? $task->status;
        $task->save();

        return response()->json([
            'status' => true,
            'message' => 'Task updated successfully.',
            'data' => [
                'task' => $task
            ]
        ], Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param Task $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request, Task $task)
    {
        $task->delete();

        return response()->json([
            'status' => true,
            'message' => 'Task deleted successfully.',
            'data' => null
        ]);
    }
}
