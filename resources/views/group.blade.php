<h2
    @class([
    'sticky top-0 z-10 py-2.5 px-4 text-xs font-semibold text-gray-900',
    'bg-gray-100 text-gray-900' => !$onDarkMode,
    'bg-gray-800 text-gray-100' => $onDarkMode,
    ])>
    <span x-text="result.group"></span>
</h2>
