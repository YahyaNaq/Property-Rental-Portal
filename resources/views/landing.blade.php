<x-layout title="Available Properties">
    <div class="min-h-full">
        <main>
        {{-- {{dd(Auth::guard('admins')->check())}} --}}
            <h1>RentOut</h1>
        </main>

        @if(session()->has('success'))
            <x-flash/>
        @endif
    </div>
</x-layout>
