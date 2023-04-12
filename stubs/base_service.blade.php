@php
    echo "<?php" . PHP_EOL;
@endphp

namespace {{ $namespace }};

abstract class BaseService
{
    protected $model;
    protected array $columns = ['*'];

    public function query()
    {
        return $this->model::query();
    }

    public function all(array $columns = ['*'])
    {
        return $this->model::all($this->getColumns($columns));
    }

    public function paginate(int $perPage = 15, array $columns = ['*'], string $pageName = 'page', int $page = 1)
    {
        return $this->query()->paginate($perPage, $this->getColumns($columns), $pageName, $page);
    }

    public function create(array $data)
    {
        return $this->query()->create($data);
    }

    public function updateOrCreate(array $search, array $data)
    {
        return $this->query()->updateOrCreate($search, $data);
    }

    public function update($id, array $data)
    {
        return ($this->find($id))->update($data);
    }

    public function updateByAttribute($attribute, $value, array $data)
    {
        return $this->query()->where($attribute, $value)->update($data);
    }

    public function delete($id)
    {
        return ($this->find($id))->delete();
    }

    public function find($id, array $columns = ['*'])
    {
        return $this->query()->findOrFail($id, $this->getColumns($columns));
    }

    public function findByAttribute($attribute, $value, array $columns = ['*'])
    {
        return $this->query()->where($attribute, $value)->first($this->getColumns($columns));
    }

    public function findOrFailByAttribute($attribute, $value, array $columns = ['*'])
    {
        return $this->query()->where($attribute, $value)->firstOrFail($this->getColumns($columns));
    }

    private function getColumns(array $columns): array
    {
        return $columns === ['*'] ? $this->columns : $columns;
    }
}
