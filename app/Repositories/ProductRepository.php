<?php
namespace App\Repositories;

use App\Models\Product;
use App\BO\ProductBO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(int $perPage = 10, ?int $categoryId = null): LengthAwarePaginator
    {
        $cacheKey = "products_page_{$perPage}_category_" . ($categoryId ?? 'all');

        return Cache::remember($cacheKey, 60, function () use ($perPage, $categoryId) {
            $query = Product::with('category');

            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }

            return $query->paginate($perPage)->through(fn($product) => new ProductBO($product));
        });
    }

    public function find(int $id):ProductBO
    {
        $product = Product::with('category')->findOrFail($id);
        return new ProductBO($product);
    }
    

    public function store( array $data):ProductBO
    {
        Cache::forget('products_all');
        $product = Product::create($data);
        return new ProductBO($product);
    }

    public function update(int $id, array $data): ProductBO
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        Cache::forget("products_all");
        return new ProductBO($product);
    }

    public function delete(int $id): bool
    {
        $deleted=Product::destroy($id);
        Cache::forget("product_{$id}");
        Cache::forget("products_all");

        return $deleted;
    }
}
