<?php

namespace App\Http\Controllers;

use App\Http\Requests\ButtonValidator;
use App\Services\ButtonService;
use Exception;
use Illuminate\Http\Request;

class ButtonController extends Controller
{
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ButtonService $service)
    {
        $this->service = $service;
        $this->middleware('auth');
    }

    /**
     * Cria ou atualiza um botão
     *
     * @param ButtonValidator $request
     * @return void
     */
    public function createOrUpdate(ButtonValidator $request)
    {
        return $this->service->save($request);
    }

    /**
     *Remove um botão
     *
     * @param Request $request
     * @return void
     */
    public function delete(Request $request)
    {
        return $this->service->delete($request);
    }
}
