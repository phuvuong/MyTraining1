<?php

namespace App\Services;

use App\Repositories\HomeRepositoryInterface;


class HomeService
{
    protected $homeRepository;

    public function __construct(HomeRepositoryInterface $homeRepository)
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


}

