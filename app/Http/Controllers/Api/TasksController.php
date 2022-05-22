<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTaskRequest;
use App\Http\Requests\ShowTaskRequest;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskStatusRequest;
use App\Http\Requests\UserTasksRequest;
use App\Http\Services\TasksService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    /**
     * service attribute
     *
     * @var TasksService
     */
    protected TasksService $service;

    /**
     * construct method
     *
     * @param TasksService $service
     */
    public function __construct(TasksService $service)
    {
        $this->service = $service;
    }

    /**
     * get all tasks function
     *
     * @return JsonResponse
     */
    public function index(UserTasksRequest $request): JsonResponse
    {
        $response = $this->service->getUserTasks($request->userId);
        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * create new task function
     *
     * @param CreateTaskRequest $request
     * @return JsonResponse
     */
    public function post(CreateTaskRequest $request): JsonResponse
    {
        $response = $this->service->createTask($request->all(), Auth::user()->id);
        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * return infos about one task
     *
     * @return JsonResponse
     */
    public function show(ShowTaskRequest $request): JsonResponse
    {
        $response = $this->service->showUserTask($request->id);
        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * return only the user last task
     *
     * @return JsonResponse
     */
    public function showLastTask(): JsonResponse
    {
        $response = $this->service->getUserLastTask(Auth::user()->id);
        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * update task function
     *
     * @param TaskRequest $request
     * @return JsonResponse
     */
    public function updateTask(TaskRequest $request): JsonResponse
    {      
        $response = $this->service->updateTask($request->all(), Auth::user()->id, $request->id);
        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * update task status function
     *
     * @param TaskStatusRequest $request
     * @param integer $id
     * @return JsonResponse
     */
    public function updateTaskStatus(TaskStatusRequest $request): JsonResponse
    {
        $response = $this->service->updateStatus($request->all(), $request->id);
        return response()->json($response, JsonResponse::HTTP_OK);
    }

    /**
     * delete a task
     *
     * @param integer $id
     * @return JsonResponse
     */
    public function delete(ShowTaskRequest $request): JsonResponse
    {   
        $response = $this->service->deleteTask($request->id);
        return response()->json($response, JsonResponse::HTTP_OK);
    }
}
