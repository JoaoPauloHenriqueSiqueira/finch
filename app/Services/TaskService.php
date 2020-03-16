<?php

namespace App\Services;

use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskService
{
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        TaskRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Get repository
     */
    public function get()
    {
        $tasks = $this->repository->all()->get();

        foreach ($tasks as $task) {
            $buttons = array_get($task, "buttons", []);
            foreach ($buttons as &$button) {
                $task = $this->find(array_get($button, "next_id"));
                $button['name'] = array_get($task, "name");
            }
        }
        return $tasks;
    }

    /**
     * GEt type of a task
     *
     * @param [type] $type
     * @return void
     */
    public function getType($type)
    {
        return collect($this->get())->where('type_id', $type);
    }

    /**
     * Get repository
     */
    public function getAll()
    {
        $tasks = $this->repository->all()->get();
        return $this->namedButton($tasks);
    }

    /**
     * Name button task
     *
     * @param [type] $tasks
     * @return void
     */
    public function namedButton($tasks)
    {
        foreach ($tasks as $task) {
            $buttons = array_get($task, "buttons", []);
            foreach ($buttons as &$button) {
                $task = $this->find(array_get($button, "next_id"));
                $button['name'] = array_get($task, "name");
            }
        }

        return $tasks;
    }

    /**
     * FInd a register with a diferent id
     *
     * @param [type] $taskId
     * @return void
     */
    public function findNot($taskId)
    {
        return $this->repository->findNot($taskId);
    }

    /**
     * FUnction to search a task
     *
     * @param [type] $taskId
     * @return void
     */
    public function find($taskId)
    {
        return $this->repository->find($taskId);
    }

    /**
     * Save a task with a validation
     *
     * @param [type] $request
     * @return void
     */
    public function save($request)
    {
        $taskId = array_get($request, "id");
        $validated = $request->validated();

        $response = $this->repository->save($validated, $taskId);

        if ($response) {
            return redirect()->back()->with('message', 'Registro criado/atualizado!');
        }

        return redirect()->back()->with('message', 'Ocorreu algum erro');
    }

    /**
     * Remove specific task
     *
     * @param [type] $request
     * @return void
     */
    public function delete($request)
    {
        $taskId = array_get($request, "id");

        $task = $this->repository->where($taskId)->get()->first();

        $task->flows()->detach();

        $response = $this->repository->delete($taskId);
        if ($response) {
            return response('Removido com sucesso', 200);
        }

        return response('Ocorreu algum erro ao remover', 422);
    }
}
