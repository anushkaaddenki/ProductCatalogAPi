<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        // Create Parent Categories
        $electronics = Category::create(['name' => 'Electronics']);
        $fashion = Category::create(['name' => 'Fashion']);

        // Create Subcategories
        Category::create(['name' => 'Laptops', 'parent_category_id' => $electronics->id]);
        Category::create(['name' => 'Mobile Phones', 'parent_category_id' => $electronics->id]);
        Category::create(['name' => 'Men\'s Clothing', 'parent_category_id' => $fashion->id]);
        Category::create(['name' => 'Women\'s Clothing', 'parent_category_id' => $fashion->id]);
    }
}
