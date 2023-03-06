<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'category_name' => 'Xe Máy',
            'category_status'=> '1'
        ]);
        Category::create([
            'category_name' => 'Ô Tô',
            'category_status'=> '1'
        ]);
        Category::create([
            'category_name' => 'Xe Tải',
            'category_status'=> '1'
        ]);
    }
}
