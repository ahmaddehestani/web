<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;


class BaseRepository implements BaseRepositoryInterface
{
    public function __construct(public Model $model)
    {
    }

    public function query(array $payload = []): Builder|QueryBuilder
    {
        return $this->model->query();
    }

    public function paginate($limit = 15, array $payload = [])
    {
        if ($limit == null) {
            $limit = 15;
        }
        if ($limit===-1){
            return $this->all($payload);
        }
        return $this->query($payload)->paginate($limit);
    }

    public function all(array $payload = [])
    {
        return $this->query($payload)->get();
    }

    public function create(array $payload): Model
    {
        return $this->model->create($payload);
    }

    public function update($eloquent, array $payload): Model
    {
        $eloquent->update($payload);
        return $eloquent;
    }

    public function delete($eloquent): bool
    {
        return $eloquent->delete();
    }

    public function find(mixed $value, string $filed = 'id', array $selected = ['*'], bool $firstOrFail = false, array $with = []): ?Model
    {
        $model = $this->getModel()->with($with)->select($selected)->where($filed, $value);

        if ($firstOrFail) {
            return $model->firstOrFail();
        }

        return $model->first();
    }

    public function getModel(): Model
    {
        return $this->model;
    }
    public function updateOrCreate(array $data, array $conditions = [])
    {
        return $this->model->updateOrCreate($conditions, $data);
    }
}
