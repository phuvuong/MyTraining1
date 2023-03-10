<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Brand;
use Illuminate\Support\Facades\Hash;

class CreateBrand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:brand {name} {status} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new brand';

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
        $brand = new Brand;
        $brand->name = $this->argument('name');
        $brand->status = $this->argument('status');

        $brand->save();

        $this->info('Brand ' . $brand->name . ' created successfully!');
    }

}
