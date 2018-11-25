<?php namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // Get all instances of model with pagination
    public function allPaginate(int $count)
    {
        return $this->model->paginate($count);
    }

    // Eager load database relationships
    public function with(array $relations)
    {
        return $this->model->with($relations)->get();
    }

    // Eager load database relationships with pagination
    public function withAndPaginate(array $relations, int $count)
    {
        return $this->model->with($relations)->paginate($count);
    }

    //
    public function take(int $count)
    {
        return $this->model->orderBy('created_at', 'desc')->take($count)->get();
    }

    // show the record with the given id
    public function selectById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    // show the record with the given column and value
    public function selectByColumn(string $column, string $query)
    {
        return $this->model->where($column, $query)->first();
    }

    //
    public function pluck(string $key, string $value)
    {
        return $this->model->all()->pluck($key, $value);
    }

    // create a new record in the database
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    // update record in the database
    public function update(array $data, int $id)
    {
        $record = $this->find($id);
        return $record->update($data);
    }

    // remove record from the database
    public function delete(int $id)
    {
        return $this->model->delete($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

}
