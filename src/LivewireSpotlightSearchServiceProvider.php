<?php

namespace TntFreskimVeliu\LivewireSpotlightSearch;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireSpotlightSearchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/spotlight-search.php' => config_path('livewire-spotlight-search.php'),
        ], 'livewire-spotlight-search-config');

        $this->publishes([
            __DIR__ . '/../resources/views' => public_path('vendor/livewire-spotlight-search'),
        ], 'livewire-spotlight-search-views');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'spotlight-search');

        Livewire::component('spotlight-search', SpotlightSearch::class);

        $this->registerBladeDirective();
    }

    protected function registerBladeDirective()
    {
        Blade::directive('livewireSpotlightSearchScript', function () {
            return <<<'HTML'
            <script>
                window.spotlightSearch = (config) => {
    const component = window.Livewire.find(config.componentId);

    return {
        inputPlaceholder: component.get('inputPlaceholder'),
        shouldGroup: component.get('shouldGroup'),
        showNoResultsView: component.get('showNoResultsView'),
        showInitialView: component.get('showInitialView'),

        queryResultsList: null,
        queryResults: component.entangle('results'),

        selected: 0,
        isOpen: component.entangle('isOpen').defer,
        input: '',

        init() {
            this.$watch('queryResults', value => {
                this.queryResultsList = value
            });

            this.$watch('input', async value => {
                if (value.length === 0) {
                    this.selected = 0;
                }

                await this.$wire.search(value)
            });

            this.$watch('isOpen', value => {
                if (value === false) {
                    setTimeout(() => {
                        this.input = '';
                        this.inputPlaceholder = config.placeholder;
                    }, 300);
                }
            });
        },

        toggleOpen() {
            if (this.isOpen) {
                this.isOpen = false;
                return;
            }
            this.input = ''
            this.isOpen = true
            setTimeout(() => {
                this.$refs.input.focus()
            }, 100)
        },

        filteredItems() {
            if (this.queryResultsList && this.queryResultsList.length) {
                return this.queryResultsList
            }

            return [];
        },

        goTo(id, searchable) {
            component.onSelect(id, searchable);
        },
    };
};
            </script>
HTML;
        });
    }
}
