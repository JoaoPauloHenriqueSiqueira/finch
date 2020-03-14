<?php

namespace App\Services;

use App\Repositories\Contracts\FlowRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class FlowService
{
    protected $repository;
    protected $taskService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        FlowRepositoryInterface  $repository,
        TaskService $taskService
    ) {
        $this->repository = $repository;
        $this->taskService = $taskService;
    }

    /**
     * Get repository
     */
    public function get()
    {
        $flows = $this->repository->all()->get();

        $list = [];
        foreach ($flows as $flow) {
            $tasks = collect($flow->tasks)->count();
            if ($tasks > 0) {
                array_push($list, $flow);
            }
        }
        return $list;
    }

    public function tasks($request)
    {
        return $this->repository->where(["id", array_get($request, "id")])->first();
    }

    public function getNotFinished()
    {
        return $this->getLastTask($this->repository->where(["finish", 0]));
    }

    public function getLastTask($flow)
    {
        foreach ($flow as $v) {
            $lastTask = collect($v->tasks)->last();
            if ($lastTask) {
                $task = $this->taskService->find($lastTask->id);

                $buttons = collect($task->buttons)->all();
                foreach ($buttons as $v2) {
                    $v2['name'] = array_get(
                        collect(
                            $this->taskService->find(
                                array_get($v2, "next_id")
                            )
                        )->only(['name']),
                        "name"
                    );
                }
                $lastTask->buttons = $buttons;
                $v['taskAtual'] = $lastTask;
            }
        }

        return $flow;
    }

    public function find($taskId)
    {
        return $this->repository->find($taskId);
    }

    public function create($request)
    {
        $newData = [];
        $newData['user_id'] = Auth::user()->id;
        $flow = $this->repository->create($newData);
        $flow->tasks()->attach(array_get($request, "task_id"), ["note" => array_get($request, "note")]);
        return redirect()->back()->with('message', 'Registro criado/atualizado!');
    }

    public function update($request)
    {
        $flow = $this->repository->find(array_get($request, "flow_id"));
        $flow->tasks()->attach(array_get($request, "task_id"), ["note" => array_get($request, "note")]);

        $type = array_get(
            collect(
                $this->taskService->find(
                    array_get($request, "task_id")
                )
            )->only(['type_id']),
            "type_id"
        );
        if ($type == 3) {
            $flow['finish'] = true;
            $flow->save();
        }
        return redirect()->back()->with('message', 'Registro criado/atualizado!');
    }

    public function save($request)
    {
        $response = $this->repository->save($request);

        if ($response) {
            return redirect()->back()->with('message', 'Registro criado/atualizado!');
        }

        return redirect()->back()->with('message', 'Ocorreu algum erro');
    }


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
