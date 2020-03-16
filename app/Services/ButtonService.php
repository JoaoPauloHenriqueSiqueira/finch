<?php

namespace App\Services;

use App\Repositories\Contracts\ButtonRepositoryInterface;

class ButtonService
{
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ButtonRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Get repository
     */
    public function get()
    {
        return $this->repository->all()->get();
    }

    /**
     * Save and validate Button
     *
     * @param [type] $request
     * @return void
     */
    public function save($request)
    {
        $validated = $request->validated();
        if (!$validated) {
            return $validated;
        }
        $response = $this->repository->save($request);

        if ($response) {
            return redirect()->back()->with('message', 'Registro criado/atualizado!');
        }

        return redirect()->back()->with('message', 'Ocorreu algum erro');
    }

    /**
     * Delete specific button
     *
     * @param [type] $request
     * @return void
     */
    public function delete($request)
    {
        $taskId = array_get($request, "id");
        $response = $this->repository->delete($taskId);

        if ($response) {
            return response('Removido com sucesso', 200);
        }

        return response('Ocorreu algum erro ao remover', 422);
    }
}
