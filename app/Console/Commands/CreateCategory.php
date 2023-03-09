<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Category;

class CreateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:category {category_name} {category_status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new category';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $category = new Category();
        $category->category_name = $this->argument('category_name');
        $category->category_status = $this->argument('category_status');

        $category->save();

        $this->info('Category' . $category->category_name . 'created successfully!');
    }
}
