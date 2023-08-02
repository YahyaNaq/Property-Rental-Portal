<x-layout title="{{ $property['title'] }}">
    <div class="min-h-full">
        <x-show_card :property="$property" :username="$username" />
    </div>
</x-layout>