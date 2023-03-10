<?php

namespace App\Repositories;

interface BrandRepositoryInterface extends BaseRepositoryInterface
{
    public function getActiveBrands();

    public function getBrands();

}
