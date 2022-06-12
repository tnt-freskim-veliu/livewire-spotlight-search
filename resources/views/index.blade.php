<div>
    <div x-data="spotlightSearch({ componentId: '{{ $this->id }}' })"
         x-show="isOpen"
         x-cloak
         x-on:open-spotlight.window="toggleOpen()"
         @keydown.window.prevent.cmd.k="toggleOpen()"
         @keydown.window.prevent.cmd.slash="toggleOpen()"
         @keydown.window.prevent.ctrl.k="toggleOpen()"
         @keydown.window.prevent.ctrl.slash="toggleOpen()"
         @keydown.window.escape="isOpen = false"
         @toggle-spotlight.window="toggleOpen()"
         class="fixed z-50 px-4 pt-16 flex items-start justify-center inset-0 sm:pt-24">

        <div x-show="isOpen"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
        </div>

        <div @click.away="isOpen = false"
             x-show="isOpen"
             x-transition:enter="ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="relative bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-xl w-full">

            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                     class="pointer-events-none absolute top-3.5 left-4 h-5 w-5 text-gray-400">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd"></path>
                </svg>

                <input
                    x-ref="input"
                    x-model.debounce.{{ $inputDebounce }}="input"
                    :placeholder="inputPlaceholder" type="text"
                    class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-gray-800 placeholder-gray-400 focus:ring-0 sm:text-sm"/>
            </div>

            <ul
                x-ref="results"
                class="max-h-80 scroll-pt-11 scroll-pb-2 overflow-y-auto relative" role="listbox">
                <template
                    x-for="result in filteredItems()">

                    <li>
                        <template x-if="shouldGroup">
                            @include($groupView)
                        </template>

                        <ul class="text-sm text-gray-800" role="none">
                            <template x-for="item in result.items">
                                @include($itemView)
                            </template>
                        </ul>
                    </li>

                </template>

                <template x-if="filteredItems().length == 0 && input.length > 0">
                    @include($noResultsView)
                </template>

                <template x-if="input.length == 0 && showInitialView">
                    @include($initialView)
                </template>
            </ul>
        </div>
    </div>

</div>
