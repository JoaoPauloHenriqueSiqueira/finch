<?php

namespace App\Repositories;

use App\Models\Flows;
use App\Repositories\Contracts\FlowRepositoryInterface;

class FlowRepository implements FlowRepositoryInterface
{
    protected $model;

    public function __construct(Flows $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->with('user');
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function where($condition)
    {
        return $this->model->where(array_get($condition, 0), array_get($condition, 1))->with('tasks')->get();
    }

    public function save($data)
    {
        return $this->model->create($newData);
    }

    public function delete($taskId)
    {
        $obj = $this->model->find($taskId);
        return $obj->delete();
    }

    public function findNot($taskId)
    {
        return $this->model->where("id", "!=", $taskId);
    }

    public function find($taskId)
    {
        return $this->model->find($taskId);
    }
}
