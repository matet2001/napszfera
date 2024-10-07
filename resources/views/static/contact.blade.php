<x-app-layout>
    <div class="h-full w-full flex justify-center">
        <!-- Center the content inside this div -->
        <div class="max-w-3xl w-full flex flex-col items-center">
            <!-- Existing Content -->
            <div class="mx-auto border border-white text-center leading-5 px-6 py-6 rounded-xl m-10 container">
                <h2 class="text-2xl text-white text-center font-bold">Hibajelentés</h2>
                <br>
                <form id="bugReportForm" action="{{ route('bug.report') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Form Inputs Here -->
                    <div class="mb-4">
                        <label for="description" class="block font-semibold mb-2 text-white">Hiba Leírása:</label>
                        <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg text-black focus:outline-none focus:ring focus:ring-blue-200" rows="4" placeholder="Írd le a hibát..." required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="images" class="block font-semibold mb-2 text-white">Képek a hibáról (opcionális):</label>
                        <input type="file" name="images[]" id="images" multiple class="w-full px-4 py-2 border rounded-lg text-white focus:outline-none focus:ring focus:ring-blue-200">
                    </div>
                    <div class="mb-4">
                        <button type="submit" class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                            Küldés
                        </button>
                    </div>
                </form>
            </div>

            <!-- Success Modal -->
            <x-modal name="bug-report-success" :show="session('status') === 'bug-report-success'" focusable>
                <div class="p-6 text-black">
                    <h2 class="text-lg font-medium text-black">
                        {{ __('Hibajelentés sikeresen elküldve!') }}
                    </h2>
                    <p class="mt-1 text-sm">
                        {{ __('Köszönjük a visszajelzésedet, hamarosan felvesszük veled a kapcsolatot.') }}
                    </p>
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Rendben') }}
                        </x-secondary-button>
                    </div>
                </div>
            </x-modal>

            <!-- Failure Modal -->
            <x-modal name="bug-report-failure" :show="session('status') === 'bug-report-failure'" focusable>
                <div class="p-6 text-black">
                    <h2 class="text-lg font-medium text-black">
                        {{ __('Hiba történt az elküldés közben') }}
                    </h2>
                    <p class="mt-1 text-sm">
                        {{ __('Sajnos nem sikerült elküldeni a hibajelentést. Próbáld meg újra később.') }}
                    </p>
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Bezárás') }}
                        </x-secondary-button>
                    </div>
                </div>
            </x-modal>
        </div>
    </div>
</x-app-layout>
