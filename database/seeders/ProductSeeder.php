<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::insert([
            [
                'name' => 'MacBook Pro 14"',
                'description' => 'M2 Pro Chip, 16GB RAM, 512GB SSD',
                'sku' => 'MBP14-2023',
                'price' => 1999.99,
                'category_id' => 2, // Assuming 'Laptops' category has ID 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'iPhone 14 Pro',
                'description' => '128GB, Space Black, A16 Bionic Chip',
                'sku' => 'IPH14PRO',
                'price' => 1099.99,
                'category_id' => 3, // Assuming 'Mobile Phones' category has ID 3
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nike Air Max',
                'description' => 'Running Shoes, Size 10',
                'sku' => 'NIKE-AMX',
                'price' => 149.99,
                'category_id' => 4, // Assuming 'Men\'s Clothing' category has ID 4
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
