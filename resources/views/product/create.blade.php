<x-app-layout>
    <div class="flex justify-center items-center">
        <div class="w-full max-w-lg p-8 rounded-lg">
            <h1 class="text-2xl font-bold mb-6 text-center">Új Termék Hozzáadása</h1>

            <!-- Form -->
            <form id="productForm" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Termék Neve -->
                <div class="mb-4">
                    <label for="name" class="block font-semibold mb-2">Termék Neve:</label>
                    <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg text-black focus:outline-none focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Leírás -->
                <div class="mb-4">
                    <label for="description" class="block font-semibold mb-2">Leírás:</label>
                    <textarea name="description" id="description" class="w-full px-4 py-2 border rounded-lg text-black focus:outline-none focus:ring focus:ring-blue-200" rows="4"></textarea>
                </div>

                <!-- Ár -->
                <div class="mb-4">
                    <label for="price" class="block font-semibold mb-2">Ár (HUF):</label>
                    <input type="number" name="price" id="price" step="0.01" class="w-full px-4 py-2 border rounded-lg text-black focus:outline-none focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Termék Típusa -->
                <div class="mb-4">
                    <label for="type" class="block font-semibold mb-2">Termék Típusa:</label>
                    <select name="type" id="type" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200 text-black" required>
                        <option value="meditation">Meditáció</option>
                        <option value="audiobook">Hangoskönyv</option>
                        <option value="lecture">Előadás</option>
                    </select>
                </div>

                <!-- Image Selection -->
                <div class="mb-4">
                    <label for="image" class="block font-semibold mb-2">Válassz egy Képfájlt:</label>
                    <button type="button" name="image" id="imageButton" class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition">Válassz Képfájlt</button>
                </div>

                <!-- Audio Selection -->
                <div class="mb-6">
                    <label for="browseFile" class="block font-semibold mb-2">Válassz egy Hangfájlt (MP3):</label>
                    <button type="button" id="audioButton" class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition">Válassz Hangfájlt</button>
                </div>

                <!-- Progress Bars -->
                <div class="image-progress hidden bg-gray-200 rounded-lg overflow-hidden mt-4">
                    <div class="progress-bar bg-blue-500 h-6 text-white text-center font-bold"></div>
                </div>

                <div class="audio-progress hidden bg-gray-200 rounded-lg overflow-hidden mt-4">
                    <div class="progress-bar bg-blue-500 h-6 text-white text-center font-bold"></div>
                </div>

                <!-- Hidden fields for file paths -->
                <input type="hidden" name="imageFilePath" id="imageFilePath">
                <input type="hidden" name="audioFilePath" id="audioFilePath">

                <!-- Submit Button -->
                <div class="flex justify-center mt-6">
                    <button id="submitButton" type="submit" class="bg-gray-500 text-white font-semibold px-6 py-2 rounded-lg cursor-not-allowed" disabled>Termék Létrehozása</button>
                </div>

                <div id="message" class="mt-4 text-center text-lg"></div>
            </form>
        </div>
    </div>
</x-app-layout>

<!-- jQuery -->
<script src="{{ asset('assets/js/jQuery.js') }}" ></script>

<!-- Resumable JS -->
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.1.0/resumable.min.js"></script>

<script type="text/javascript">
    window.uploadRoutes = {
        uploadUrl: "{{ route('product.upload') }}",
        csrfToken: "{{ csrf_token() }}"
    };
</script>

@vite('resources/js/product-upload.js');
