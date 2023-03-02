<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\HomeRepository;
use App\Models\Product;

class HomeService
{
    protected $homeRepository;
    public function __construct(HomeRepository $homeRepository)
    {
        $this->homeRepository = $homeRepository;
    }
    public function getActiveCategories()
    {
        return $this->homeRepository->getActiveCategories();
    }
    public function getActiveBrands()
    {
        return $this->homeRepository->getActiveBrands();
    }
    public function getProducts()
    {
        return $this->homeRepository->getProducts();
    }
    public function getProductsWithCategories($category_id)
    {
        return $this->homeRepository->getProductsWithCategories($category_id);
    }
}
?>