<x-agent.layout title="{{ $property['title'] }}">
    <div class="min-h-full">
        <x-show_card :property="$property" :username="$username" />
    </div>
</x-agent.layout>