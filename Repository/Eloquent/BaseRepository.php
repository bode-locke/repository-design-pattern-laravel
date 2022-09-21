<?php

namespace App\Repository\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Interfaces\BaseInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BaseRepository implements BaseInterface
{
    /**
     * @var Model
     */
    protected Model $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Create record
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     *  Update record
     * @param array $attributes
     * @return Model
     */
    public function update(array $attributes): Model
    {
        $item = $this->findOrFail($attributes['id'], []);

        $item->update($attributes);

        return $item;
    }

    /**
     * createOrUpdate
     *
     * @param  array $data
     * @return void
     */
    public function createOrUpdate(array $data): Model
    {
        // dd($data);
        if (isset($data['id'])) {
            $model = $this->model->find($data['id']);
            $model->update($data);
            //dd('ok');
            return  $model;
        }
        return  $this->model->create($data);

        // return $factor;
    }

    /**
     * Delete record
     * @param int $id
     * @return Bool
     */
    public function delete(int $id): bool
    {
        $item = $this->model->find($id);

        $item->delete();

        return true;
    }

    /**
     * Find a record
     * @param int $id
     * @param array $relations
     * @return Model|null
     */
    public function find(int $id, array $relations): ?Model
    {
        return $this->model->with($relations)->find($id);
    }

    /**
     * Find or fail a record
     * @param int $id
     * @param array $relations
     * @return Model|null
     */
    public function findOrFail(int $id, array $relations): ?Model
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    /**
     * Find a record by key
     *
     * @param string $key
     * @param string $value
     * @return Model|null
     */
    public function findByKey(string $key, string $value): ?Model
    {
        return $this->model->where($key, $value)->first();
    }

    /**
     * Find all records by key
     *
     * @param mixed $key
     * @param mixed $value
     * @return Model
     */
    public function getByKey(string $key, string $value): ?Collection
    {
        return $this->model->where($key, $value)->get();
    }

    /**
     * Get all records with relations, pagination and ordered
     *
     * @param array $relations
     * @param string $key
     * @param string $orderBy
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(array $relations, string $key, string $orderBy, int $perPage): LengthAwarePaginator
    {
        return $this->model->with($relations)->orderBy($key, $orderBy)->paginate($perPage);
    }

    /**
     * Get all records
     *
     * @param string $key
     * @param string $orderBy
     * @param array $relations
     * @return Collection
     */
    public function getAll(string $key, string $orderBy, array $relations): Collection
    {
        return $this->model->with($relations)->orderBy($key, $orderBy)->get();
    }

    /**
     * Get only fields
     *
     * @param string $key
     * @param array $relations
     * @param array $modelFields
     * @return array
     */

    public function getOnlyFields(string $key, array $relations, array $modelFields): array
    {
        return $this->model->with($relations)->orderBy($key, 'asc')->get($modelFields)->toArray();
    }


    /**
     * Get records and pluck for select input
     *
     * @param string $key1
     * @param string $key2
     * @return array
     */
    public function getForSelect(string $key1, string $key2): array
    {
        $items = $this->model->orderBy($key1, 'asc')->get()->pluck($key1, $key2);

        foreach ($items as $key => $item) {
            $items[$key] = ucfirst($item);
        }

        return $items->toArray();
    }

    /**
     * Get records and pluck for select input where ...
     *
     * @param string $key1
     * @param string $key2
     * @param string $whereColumn
     * @param string $whereValue
     * @return array
     */
    public function getWhereForSelect(string $key1, string $key2, string $whereColumn, string $whereValue): array
    {
        $items = $this->model->where($whereColumn, $whereValue)->orderBy($key1, 'asc')->get()->pluck($key1, $key2);

        foreach ($items as $key => $item) {
            $items[$key] = ucfirst($item);
        }

        return $items->toArray();
    }

    /**
     * Get records grouped by key
     *
     * @param string $key
     * @return Collection
     */
    public function groupByKey(string $key): Collection
    {
        return $this->model->get()->groupBy($key);
    }
}
