<?php

namespace App\Repositories;

use App\Models\Buttons;
use App\Repositories\Contracts\ButtonRepositoryInterface;

class ButtonRepository implements ButtonRepositoryInterface
{
    protected $model;

    public function __construct(Buttons $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->with('type');
    }

    public function save($data)
    {
        $taskId = array_get($data, "task_id");
        $nextId = array_get($data, "next_id");

        $obj = $this->model->updateOrCreate(["task_id" => $taskId, "next_id" => $nextId], $data->all());
        return $obj->save();
    }

    public function delete($buttonId)
    {
        $obj = $this->model->find($buttonId);
        if ($obj) {
            return $obj->delete();
        }

        return [];
    }

    public function findNot($taskId)
    {
        return $this->model->where("id", "!=", $taskId);
    }
}
