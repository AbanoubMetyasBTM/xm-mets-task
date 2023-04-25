<?php

namespace App\Providers;

use App\Adapters\ICompaniesListing;
use App\Adapters\IHistoricalData;
use App\Adapters\Implementation\CompaniesList\Datahub;
use App\Adapters\Implementation\HistoricalData\FakeRapidapi;
use App\Adapters\Implementation\HistoricalData\Rapidapi;
use App\Services\IHomeService;
use App\Services\Implementation\HomeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->bind(IHomeService::class, HomeService::class);

        $this->app->bind(ICompaniesListing::class, Datahub::class);
        $this->app->bind(IHistoricalData::class, Rapidapi::class);

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
