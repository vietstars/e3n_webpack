<?php

namespace App\Providers;

use Arr;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;
use URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function ($attributes, string $searchTerm = null) {
            foreach (Arr::wrap($attributes) as $attribute) {
                if ($searchTerm) {
                    $this->where($attribute, 'LIKE', "%{$searchTerm}%");
                }
            }

            return $this;
        });
        Builder::macro('orWhereLike', function ($attributes, string $searchTerm = null) {
            foreach (Arr::wrap($attributes) as $attribute) {
                if ($searchTerm) {
                    $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                }
            }

            return $this;
        });

        // $this->forceSSL();
        $this->bindServices();
    }

    /**
     * Force SSL for testing & production.
     *
     * @return void
     */
    protected function forceSSL()
    {
        if ($this->app->environment(['production', 'testing'])) {
            URL::forceScheme('https');
        }
    }

    /**
     * Bind services of Application.
     *
     * @return void
     */
    protected function bindServices()
    {
        foreach (Arr::wrap(config('app.services')) as $alias => $service) {
            $this->app->singleton($alias, function ($app) use ($service) {
                return $app->make($service);
            });
        }
    }
}
