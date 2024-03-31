<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class MainRepository
{
    private Model $model;

    public function __construct(Model $model)
    {
        return $this->model = $model;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function findById($id)
    {
        return $this->model::find($id);
    }

    public function findByColumn($column, $value)
    {
        return $this->model::where($column, $value)->get();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update($id ,array $data)
    {
        return $this->findById($id)->update($data);
    }

    public function delete($id)
    {
        $this->findById($id)->delete();
    }

    public function forceDelete($id)
    {
        $this->findById($id)->forceDelete();
    }

    public function whereIn($id, $values)
    {
        return $this->model::WhereIn($id, $values)->get();
    }

    public function first()
    {
        return $this->model::first();
    }
}
