<x-layout title="{{ $user->full_name }}">
    <div class="min-h-full">
        <x-header heading="{{ $user->id == Auth::id() ? 'Your Profile' : 'User Profile' }}"/>
            <x-profile_card />
    </div>
</x-layout>