<?php

namespace App\Providers;

use App\Services\ImageSearch\Cache\LocalCacheSearchResultService;
use App\Services\ImageSearch\Google\GoogleImageSearchService;
use App\Services\ImageSearch\ImageSearchService;
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
        $this->app->bind(ImageSearchService::class, function () {
            return new GoogleImageSearchService(
                config('imagesearch.google.engine_id'),
                config('imagesearch.google.api_key'),
                config('imagesearch.google.base_url'),
                new LocalCacheSearchResultService(
                    config('imagesearch.cache.enabled'),
                    config('imagesearch.cache.data_key'),
                    config('imagesearch.cache.ttl')
                )
            );
        });
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
