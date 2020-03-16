<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use Exception;

class TasksControllerApi extends Controller
{
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskService $service)
    {
        $this->service = $service;
    }

    /**
     * Lista all tasks
     *
     * @return void
     */
    public function get()
    {
        try {
            return response()->json($this->service->get(), 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());

        }
    }
}
