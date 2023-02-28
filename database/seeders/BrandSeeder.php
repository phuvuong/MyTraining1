<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'brand_name' => 'Honda',
            'brand_status'=> '1'
        ]);
        Brand::create([
            'brand_name' => 'Yamaha',
            'brand_status'=> '1'
        ]);
        Brand::create([
            'brand_name' => 'Ducati',
            'brand_status'=> '1'
        ]);
    }
}
