<?php

namespace App\Repositories;

use App\Models\Tasks;
use App\Repositories\Contracts\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    protected $model;

    public function __construct(Tasks $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('created_at', 'desc')->with('type')->with('buttons');
    }

    public function save($data, $taskId = null)
    {
        $obj = $this->model->updateOrCreate(["id" => $taskId], $data);
        return $obj->save();
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

    public function where($taskId)
    {
        return $this->model->where("id", $taskId)->with('flows');
    }
}
