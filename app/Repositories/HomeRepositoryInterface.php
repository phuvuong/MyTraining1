<?php

  namespace App\Repositories;

  use Illuminate\Http\Request;

  interface HomeRepositoryInterface extends BaseRepositoryInterface
    {
        public function getActiveCategories();
        public function getActiveBrands();
        public function getProducts($product_id);
        public function getCategories();
        public function getBrands();
        public function getProductswithCategories($category_id);
    }
?>