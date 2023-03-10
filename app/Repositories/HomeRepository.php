<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Brand;

class HomeRepository extends BaseRepository implements HomeRepositoryInterface
{
    protected $category;
    protected $brand;

    public function __construct(Category $category, Brand $brand)
    {
        parent::__construct($category);
        parent::__construct($brand);
        $this->category = $category;
        $this->brand = $brand;
    }

    public function getActiveCategories()
    {
        return $this->category->where('category_status', 1)->orderBy('category_id', 'DESC')->get();
    }

    public function getActiveBrands()
    {
        return $this->brand->where('brand_status', 1)->orderBy('brand_id', 'DESC')->get();
    }

    public function getCategories()
    {
        return $this->category->orderBy('category_id', 'desc')->get();
    }

    public function getBrands()
    {
        return $this->brand->orderBy('brand_id', 'desc')->get();
    }

}


