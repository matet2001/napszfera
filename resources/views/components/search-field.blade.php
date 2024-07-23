<section class="text-center pt-6">
    <h2 class="font-bold text-2xl">Keress</h2>
    <x-forms.form action="/search" class="mt-6">
        <x-forms.input :label="false" name="q" placeholder="Egyiptom"/>

        <x-primary-button class="text-lg px-6 py-3">Keresés</x-primary-button>
    </x-forms.form>
</section>
