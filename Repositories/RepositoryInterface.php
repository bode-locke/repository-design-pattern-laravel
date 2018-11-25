<?php namespace App\Repositories;

interface RepositoryInterface
{
    public function all();

    public function allPaginate(int $count);

    public function with(array $relations);

    public function withAndPaginate(array $relations, int $count);

    public function pluck(string $key, string $value);

    public function selectById(int $id);

    public function selectByColumn(string $column, string $query);

    public function create(array $data);

    public function update(array $data, int $id);

    public function delete(int $id);
}
