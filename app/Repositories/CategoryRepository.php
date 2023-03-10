<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $category;

    public function __construct(Category $category)
    {
        parent::__construct($category);
        $this->category = $category;
    }

    public function getActiveCategories()
    {
        return $this->category->where('status', 1)->orderBy('id', 'DESC')->get();
    }


    public function getCategories()
    {
        return $this->category->orderBy('id', 'desc')->get();
    }


}


