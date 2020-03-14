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

    public function findNot($taskId)
    {
        return $this->repository->findNot($taskId);
    }

    public function find($taskId)
    {
        return $this->repository->find($taskId);
    }

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
