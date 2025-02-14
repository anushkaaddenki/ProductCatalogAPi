<?php

namespace App\Repositories;

use App\BO\ProductBO;
use Illuminate\Pagination\LengthAwarePaginator;

interface ProductRepositoryInterface
{
    public function getAll(int $perPage = 10, ?int $categoryId = null): LengthAwarePaginator;
    public function find(int $id): ?ProductBO;
    public function store(array $data): ProductBO;
    public function update(int $id, array $data): ProductBO;
    public function delete(int $id): bool;
}
