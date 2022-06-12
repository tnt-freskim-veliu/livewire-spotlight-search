<div class="border-t border-gray-100 py-14 px-6 text-center text-sm sm:px-14">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
         aria-hidden="true" class="mx-auto h-6 w-6 text-gray-400">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
    <p @class(['mt-4 font-semibold text-gray-900', 'text-gray-900' => !$onDarkMode, 'text-gray-300' => $onDarkMode])>
        {{ $noResultsTitle }}
    </p>
    <p class="mt-2 text-gray-500">
        {{ $noResultsDescription }}
    </p>
</div>
