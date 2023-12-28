<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

interface BaseRepositoryInterface
{
    public function query(array $payload = []): Builder|QueryBuilder;

    public function paginate($limit = 15, array $payload = []);

    public function all(array $payload = []);


    public function create(array $payload): Model;

    public function update($eloquent, array $payload): Model;

    public function delete($eloquent): bool;

    public function find(mixed $value, string $filed = 'id', array $selected = ['*'], bool $firstOrFail = false, array $with = []): ?Model;


    public function getModel(): Model;

    public function updateOrCreate(array $data, array $conditions = []);
}
