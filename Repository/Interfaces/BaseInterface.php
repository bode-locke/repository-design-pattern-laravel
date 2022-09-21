<?php

namespace App\Repository\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Interface BaseInterface
 * @package App\Repositories
 */
interface BaseInterface
{
    /**
     * Create record
     *
     * @param  array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Update record
     *
     * @param  array $attributes
     * @return Model
     */
    public function update(array $attributes): Model;

    /**
     * createOrUpdate
     *
     * @param  array $data
     * @return void
     */
    public function createOrUpdate(array $data);

    /**
     * Delete record
     *
     * @param  int $id
     * @return Bool
     */
    public function delete(int $id): Bool;

    /**
     * Find a record
     *
     * @param int $id
     * @param array $relations
     * @return Model|null
     */

    public function find(int $id, array $relations): ?Model;

    /**
     * Find or fail a record
     *
     * @param int $id
     * @param array $relations
     * @return Model|null
     */

    public function findOrFail(int $id, array $relations): ?Model;

    /**
     * Find a record by key
     *
     * @param string $key
     * @param string $value
     * @return Model|null
     */
    public function findByKey(string $key, string $value): ?Model;

    /**
     * Find all records by key
     *
     * @param string $key
     * @param string $value
     * @return Collection|null
     */
    public function getByKey(string $key, string $value): ?Collection;

    /**
     * Get all records with relations, pagination and ordered
     *
     * @param  array $relations
     * @param  string $key
     * @param  string $orderBy
     * @param  int $perPage
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(array $relations, string $key, string $orderBy, int $perPage): LengthAwarePaginator;

    /**
     * Get all records
     *
     * @param string $key
     * @param string $orderBy
     * @param array $relations
     * @return Collection
     */
    public function getAll(string $key, string $orderBy, array $relations): Collection;

    /**
     * Get only fields
     *
     * @param string $key
     * @param array $relations
     * @param array $modelFields
     * @return array
     */

    public function getOnlyFields(string $key, array $relations, array $modelFields): array;


    /**
     * Get records and pluck for select input
     *
     * @param  string $key1
     * @param  string $key2
     * @return array
     */
    public function getForSelect(string $key1, string $key2): array;

    /**
     * Get records and pluck for select input where ...
     *
     * @param string $key1
     * @param string $key2
     * @param string $whereColumn
     * @param string $whereValue
     * @return array
     */

    public function getWhereForSelect(string $key1, string $key2, string $whereColumn, string $whereValue): array;

    /**
     * Get records grouped by key
     *
     * @param string $key
     * @return Collection
     */

    public function groupByKey(string $key): Collection;
}
