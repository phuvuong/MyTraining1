<?php

namespace App\Services;

use App\Repositories\BrandRepositoryInterface;

class BrandService
{
    protected $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getActiveBrands()
    {
        return $this->brandRepository->getActiveBrands();
    }

}

