<?php

namespace App\Repositories\Contracts;

interface FlowRepositoryInterface
{
    public function all();
    public function save($data);
    public function create($data);
    public function delete($taskId);
    public function find($taskId);
    public function where($condition);
}
