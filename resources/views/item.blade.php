<li
    @click.prevent="goTo(item.id, result.class)"
    @class([
        'cursor-pointer px-4 py-2 text-sm',
        'hover:bg-gray-50 text-gray-800' => !$onDarkMode,
        'hover:bg-gray-700 text-gray-300' => $onDarkMode
        ])>
    <span x-text="item.name"></span>
</li>
