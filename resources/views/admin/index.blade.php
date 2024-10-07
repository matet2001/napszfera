@props(['setting'])

<x-app-layout>
    <div class="mb-5">
        <h1 class="text-3xl text-center mb-8">Admin Beállítások</h1>

        <!-- Toggle Purchase Button with Confirmation Modal Trigger -->
        <form action="{{ route('admin.toggle-purchases') }}" method="POST" class="text-center">
            @csrf

            @if($setting->purchase_enabled)
                <!-- Button to disable purchases -->
                <button type="button" class="bg-red-500 text-white px-4 py-2 rounded-lg"
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-purchase-toggle')">
                    Vásárlások Beszüntetése
                </button>
            @else
                <!-- Button to enable purchases -->
                <button type="button" class="bg-green-500 text-white px-4 py-2 rounded-lg"
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-purchase-toggle')">
                    Vásárlások Engedélyezése
                </button>
            @endif
        </form>
    </div>

    <!-- Modal Component -->
    <x-modal name="confirm-purchase-toggle" focusable>
        <form method="POST" action="{{ route('admin.toggle-purchases') }}" class="p-6 text-black">
            @csrf

            <h2 class="text-lg font-medium text-black">
                {{ $setting->purchase_enabled ? 'Biztosan beszüntetnéd a vásárlásokat?' : 'Biztosan engedélyeznéd a vásárlásokat?' }}
            </h2>

            <p class="mt-1 text-sm">
                {{ $setting->purchase_enabled
                    ? 'Ha leállítod a vásárlásokat, a felhasználók nem fognak tudni további termékeket vásárolni, amíg újra engedélyezed.'
                    : 'Ha engedélyezed a vásárlásokat, a felhasználók újra képesek lesznek termékeket vásárolni az oldalon.' }}
            </p>

            <div class="mt-6 flex justify-end">
                <!-- Cancel Button -->
                <x-secondary-button x-on:click="$dispatch('close')">
                    Mégse
                </x-secondary-button>

                <!-- Confirm Button -->
                <x-danger-button class="ms-3">
                    {{ $setting->purchase_enabled ? 'Vásárlások Beszüntetése' : 'Vásárlások Engedélyezése' }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</x-app-layout>
