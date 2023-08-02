<x-agent.layout title="Available Properties">
    <div class="min-h-full">
        <x-agent.header heading="Available Properties"/>
            
            <x-home :properties="$properties"/>

        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-agent.layout>
