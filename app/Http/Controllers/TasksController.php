<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskPost;
use App\Services\TaskService;
use Exception;
use Illuminate\Http\Request;

class TasksController extends Controller
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
        $this->middleware('auth');
    }

    /**
     * Render a page with tasks 
     *
     * @return array
     */
    public function index()
    {
        try {
            return view('home', ["tasks" => $this->service->get()]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     *Save or create
     *
     * @param TaskPost $request
     * @return void
     */
    public function createOrUpdate(TaskPost $request)
    {
        try {
            return $this->service->save($request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Delete task
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
}
