<?php

namespace App\Repositories;

use App\Models\Brand;

class BrandRepository extends BaseRepository implements BrandRepositoryInterface
{
    protected $brand;

    public function __construct(Brand $brand)
    {
        parent::__construct($brand);
        $this->brand = $brand;
    }

    public function getActiveBrands()
    {
        return $this->brand->where('status', 1)->orderBy('id', 'DESC')->get();
    }

    public function getBrands()
    {
        return $this->brand->orderBy('id', 'desc')->get();
    }

}
