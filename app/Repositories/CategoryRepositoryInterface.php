<?php

namespace App\Repositories;

use App\BO\CategoryBO;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function getAll(): Collection;
   
}
