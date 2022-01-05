<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{

    public function all(array $related = null) : LengthAwarePaginator;

    public function get($id, array $related = null): Model;

    public function create(array $data): Model;

    public function update(array $data, int $id): Model;

    public function delete($id);

}
