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
            'name' => 'Xe Máy',
            'status'=> '1'
        ]);
        Category::create([
            'name' => 'Ô Tô',
            'status'=> '1'
        ]);
        Category::create([
            'name' => 'Xe Tải',
            'status'=> '1'
        ]);

    }
}
