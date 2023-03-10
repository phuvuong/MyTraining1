<?php

namespace App\Repositories;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveCategories();

    public function getCategories();

}
