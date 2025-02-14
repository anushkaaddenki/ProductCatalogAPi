<?php

namespace App\Repositories;

use App\BO\CategoryBO;
use App\Models\Category;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(): Collection
    {
        return Category::with('children')
            ->whereNull('parent_category_id')
            ->get()
            ->map(fn($category) => new CategoryBO($category));
    }
}
