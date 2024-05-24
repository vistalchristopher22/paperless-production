<?php

namespace App\Repositories;

use App\Contracts\IBaseRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseRepository implements IBaseRepository
{
    public function __construct(protected Model $model)
    {
    }

    public function get(): Collection
    {
        return $this->model->whereNull('deleted_at')->oldest()->get();
    }

    public function findById(int $id)
    {
        return $this->findBy(column : 'id', value : $id);
    }

    public function findBy(string $column, mixed $value)
    {
        return $this->model->where($column, $value)->first();
    }

    public function store(array $data = []): mixed
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data = []): mixed
    {
        return $model->update($data);
    }

    public function delete(Model $model)
    {
        return $model->delete();
    }
}
