<li
    @click.prevent="goTo(item.id, result.class)"
    class="cursor-pointer px-4 py-2 hover:bg-gray-50">
    <span x-text="item.name"></span>
</li>
