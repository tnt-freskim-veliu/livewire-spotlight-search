<?php

namespace TntFreskimVeliu\LivewireSpotlightSearch;

use Livewire\Component;

class SpotlightSearch extends Component
{
    public bool $isOpen = false;
    public array $results = [];
    public string $query;

    public string $inputPlaceholder = 'Search';
    public int $inputDebounce = 750;
    public string $searchable = "searchable";
    public bool $shouldGroup = true;
    public string $noResultsView = 'spotlight-search::no-results';
    public bool $showNoResultsView = true;
    public bool $showInitialView = false;
    public string $initialView = 'spotlight-search::initial';
    public string $itemView = 'spotlight-search::item';
    public string $groupView = 'spotlight-search::group';
    public bool $onDarkMode = true;

    public string $noResultsTitle = " No results found";
    public string $noResultsDescription = "We couldn’t find anything with that term. Please try again.";
    public string $initialTitle = 'Search for clients and projects';
    public string $initialDescription = 'Quickly access clients and projects by running a global search.';

    public function render()
    {
        return view('spotlight-search::index');
    }

    public function search($query): void
    {
        $this->query = $query;

        if (!$query) {
            $this->results = [];
            return;
        }

        $results = [];

        foreach ((config("livewire-spotlight-search.{$this->searchable}") ?? []) as $searchable) {
            $class = new $searchable();

            $groupData = [
                'class' => $searchable,
                'group' => $class->group(),
                'items' => $class->search($query),
            ];

            if (filled($groupData['items'])) {
                $results[] = $groupData;
            }
        }

        $this->results = $results;
    }

    public function onSelect($item, $class)
    {
        $this->isOpen = false;

        (new $class)->onSelect($item, $this);
    }
}
