<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Http\Resources\TaskCollection;
use App\Services\TaskService;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $service;

    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return new TaskCollection($this->service->getUserTasks());
    }

    public function store(TaskRequest $request)
    {
        return new TaskResource($this->service->createTask($request->validated()));
    }

    public function show($id)
    {
        return new TaskResource($this->service->getTask($id));
    }

    public function update(TaskRequest $request, $id)
    {
        return new TaskResource($this->service->updateTask($id, $request->validated()));
    }

    public function destroy($id)
    {
        $this->service->deleteTask($id);
        return response()->json(["message" => "Deleted successfully"]);
    }
}
