<?php

namespace App\Repositories\Contracts;

interface TaskRepositoryInterface
{
    public function all();
    public function save($data, $taskId);
    public function delete($taskId);
    public function findNot($taskId);
    public function find($taskId);
    public function where($taskId);

}
