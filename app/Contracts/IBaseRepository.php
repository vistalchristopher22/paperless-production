<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IBaseRepository
{
    public function get(): Collection;

    public function findBy(string $column, mixed $value);

    public function store(array $data = []): mixed;

    public function update(Model $model, array $data = []): mixed;

    public function delete(Model $model);
}
