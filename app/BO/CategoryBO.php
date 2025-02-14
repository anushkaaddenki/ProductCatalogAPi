<?php
namespace App\BO;

class CategoryBO
{
    public int $id;
    public string $name;
    public ?int $parent_category_id;
    public array $subcategories = [];

    public function __construct($category)
    {
        $this->id = $category->id;
        $this->name = $category->name;
        $this->parent_category_id = $category->parent_category_id;
        $this->subcategories = $category->children->map(fn($child) => new CategoryBO($child))->toArray();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_category_id' => $this->parent_category_id,
            'subcategories' => $this->subcategories
        ];
    }
}

