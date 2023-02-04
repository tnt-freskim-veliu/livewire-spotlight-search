<?php

namespace TntFreskimVeliu\LivewireSpotlightSearch;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route as RouteFacade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireSpotlightSearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/spotlight-search.php' => config_path('livewire-spotlight-search.php'),
        ], 'livewire-spotlight-search-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => public_path('vendor/livewire-spotlight-search'),
        ], 'livewire-spotlight-search-views');

        $this->publishes([
            __DIR__ . '/../resources/js' => public_path('vendor/livewire-spotlight-search'),
        ], 'livewire-spotlight-search-js');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'spotlight-search');
        $this->loadViewsFrom(__DIR__ . '/../resources/js', 'spotlight-search');

        Livewire::component('spotlight-search', SpotlightSearch::class);

        $this->registerBladeDirective();

        $this->registerRoutes();
    }

    protected function registerBladeDirective()
    {
        Blade::directive('livewireSpotlightSearchScript', function () {
            return <<<'HTML'
           <script src="/livewire-spotlight-search/app.js"></script>
HTML;
        });
    }

    protected function registerRoutes()
    {
        RouteFacade::get('/livewire-spotlight-search/app.js', LivewireSpotlightSearchJavaScriptAssets::class);
    }
}
