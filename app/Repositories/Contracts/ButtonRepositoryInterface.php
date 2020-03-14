<?php

namespace App\Repositories\Contracts;

interface ButtonRepositoryInterface
{
    public function all();
    public function save($data);
    public function delete($buttonId);
}
