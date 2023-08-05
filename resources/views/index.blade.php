<x-layout title="Available Properties">
    <div class="min-h-full">
        <x-header heading="Available Properties"/>
        {{-- {{ dd(session()->all()) }} --}}
            <x-home :properties="$properties"/>

        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-layout>
