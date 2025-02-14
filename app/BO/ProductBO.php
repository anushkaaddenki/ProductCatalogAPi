<?php

namespace App\BO;

class ProductBO
{
    public string $name;
    public ?string $description;
    public string $sku;
    public float $price;
    public int $category_id;
    public string $category_name;

    public function __construct($product)
    {
        $this->name = $product->name;
        $this->description = $product->description ?? 'No description available';
        $this->sku = $product->sku;
        $this->price = (float) $product->price;
        $this->category_id = $product->category_id;
        $this->category_name = $product->category ? $product->category->name : 'Uncategorized';
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'description' => $this->description,
            'sku' => $this->sku,
            'price' => $this->price,
            'category' => [
                'id' => $this->category_id,
                'name' => $this->category_name
            ]
        ];
    }
}

