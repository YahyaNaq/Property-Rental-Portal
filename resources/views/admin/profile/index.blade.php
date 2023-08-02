<x-admin.layout title="{{ $user->full_name }}">
    <div class="min-h-full">
        <x-header heading="{{ $user->id == Auth::guard('admins')->id() ? 'Your Profile' : 'User Profile' }}"/>
            <x-profile_card :user="$user" />
    </div>
</x-admin.layout>