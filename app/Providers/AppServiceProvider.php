<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        \PagSeguro\Library::initialize();
	    \PagSeguro\Library::cmsVersion()->setName("Marketplace")->setRelease("1.0.0");
	    \PagSeguro\Library::moduleVersion()->setName("Marketplace")->setRelease("1.0.0");
    }
}
