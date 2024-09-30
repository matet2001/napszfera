<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xlleading-tight">
            Profil
        </h2>
    </x-slot>

    <div class="py-6">
        <h1 class="text-center text-3xl text-white"><strong>Profil</strong></h1>
        @include('profile.partials.update-profile-information-form')
        @include('profile.partials.update-password-form')
        @include('profile.partials.delete-user-form')
    </div>
</x-app-layout>
