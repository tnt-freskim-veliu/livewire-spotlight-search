<?php

namespace TntFreskimVeliu\LivewireSpotlightSearch\Contracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

interface Searchable
{
    public function group(): string;

    public function builder(string $query): Builder;

    public function onSelect($id, Component $component);
}
