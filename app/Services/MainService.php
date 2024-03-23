<?php

namespace App\Services;

use App\Repositories\MainRepository;
use Illuminate\Database\Eloquent\Model;

class MainService
{
    private $repository;

    public function __construct(Model $model)
    {
        $this->repository = new MainRepository($model);
    }

    public function all()
    {
        return $this->repository->all();
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function findByColumn($column, $value)
    {
        return $this->repository->findByColumn($column, $value);
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($id ,$data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id,);
    }

    public function forceDelete($id)
    {
        return $this->repository->forceDelete($id,);
    }
}
