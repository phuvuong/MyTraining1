<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HomeRepositoryInterface::class , HomeRepository::class );
        $this->app->bind(ProductRepositoryInterface::class , ProductRepository::class );
        $this->app->bind(UserRepositoryInterface::class , UserRepository::class );

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
?>
