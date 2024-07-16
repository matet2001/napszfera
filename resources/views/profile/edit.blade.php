<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xlleading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')
    </div>
</x-app-layout>
