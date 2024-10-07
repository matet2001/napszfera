<x-user-form>
    <section class="space-y-6">
        <header>
            <h2 class="text-lg font-medium ">
                {{ __('Fiók törlése') }}
            </h2>

            <p class="mt-1 text-sm">
                {{ __('Miután a fiókod törlésre kerül, minden erőforrás és adat véglegesen törlődik, ezáltal minden megvásárolt terméked elveszik. Mielőtt törölnéd a fiókodat, kérjük, töltsd le minden adatodat, és terméked, amit meg szeretnél őrizni.') }}
            </p>
        </header>

        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >{{ __('Fiók törlése') }}</x-danger-button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable >
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6 text-black">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-black">
                    {{ __('Biztosan törölni szeretnéd a fiókodat?') }}
                </h2>

                <p class="mt-1 text-sm">
                    {{ __('Miután a fiókod törlésre kerül, minden erőforrás és adat véglegesen törlődik, ezáltal minden megvásárolt terméked elveszik. Kérjük, add meg a jelszavadat a fiók végleges törlésének megerősítéséhez.') }}
                </p>

                <div class="mt-6">
                    <x-input-label for="password" value="{{ __('Jelszó') }}" class="sr-only" />

                    <x-text-input
                        id="password"
                        name="password"
                        type="password"
                        class="mt-1 block w-3/4"
                        placeholder="{{ __('Jelszó') }}"
                    />

                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                </div>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Mégse') }}
                    </x-secondary-button>

                    <x-danger-button class="ms-3">
                        {{ __('Fiók törlése') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </section>
</x-user-form>
