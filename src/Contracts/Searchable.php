<?php

namespace TntFreskimVeliu\LivewireSpotlightSearch\Contracts;

use Livewire\Component;

interface Searchable
{
    public function group(): string;

    public function search(string $query): array;

    public function onSelect($id, Component $component);
}
