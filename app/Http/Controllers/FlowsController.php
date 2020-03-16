<?php

namespace App\Http\Controllers;

use App\Http\Requests\Flow;
use App\Http\Requests\TaskPost;
use App\Models\Tasks;
use App\Services\FlowService;
use App\Services\TaskService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlowsController extends Controller
{

    protected $service;
    protected $taskService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(FlowService $service, TaskService $taskService)
    {
        $this->taskService = $taskService;
        $this->service = $service;
        $this->middleware('auth');
    }

    /**
     * Render all flows not finished
     *
     * @return void
     */
    public function index()
    {
        try {
            return view('flow', [
                "flows" => $this->service->getNotFinished(),
                "tasks" => $this->taskService->getType(1)
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *Render all flows
     *
     * @return void
     */
    public function list()
    {
        try {
            return view('list', [
                "flows" => $this->service->get(),
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *Create a new flow
     *
     * @param Request $request
     * @return void
     */
    public function create(Request $request)
    {
        try {
            return $this->service->create($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *Update a flow
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        try {
            return $this->service->update($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *Delete a specific flow
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        try {
            return $this->service->delete($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *Get all tasks from a flow
     *
     * @param Request $request
     * @return void
     */
    public function getTasks(Request $request)
    {
        try {
            return $this->service->tasks($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
