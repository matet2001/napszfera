<x-app-layout>
    <div class="flex justify-center items-center min-h-screen">
        <div class="w-full max-w-lg p-8 rounded-lg">
            <h1 class="text-2xl font-bold mb-6 text-center">Új Termék Hozzáadása</h1>

            <!-- Success Message -->
            <div id="message" class="mb-4"></div>

            <!-- Progress Bar -->
            <div class="mb-4">
                <div id="progress-bar-wrapper" class="w-full bg-gray-200 rounded-lg hidden">
                    <div id="progress-bar" class="bg-blue-500 text-xs leading-none h-2 text-center text-white rounded-lg" style="width: 0%">0%</div>
                </div>
            </div>

            <!-- Form -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
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

                <!-- Termék Kép -->
                <div class="mb-4">
                    <label for="image" class="block font-semibold mb-2">Termék Kép:</label>
                    <input type="file" name="image" id="image" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200">
                </div>

                <!-- Termék Fájl (Hang) -->
                <div class="mb-6">
                    <label for="file" class="block font-semibold mb-2">Termék Fájl (Hang):</label>
                    <input type="file" name="file" id="file" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                        Termék Létrehozása
                    </button>
                </div>
            </form>

            <!-- Success or Error Message -->
            <div id="message" class="mt-4 text-center"></div>
        </div>
    </div>

{{--    <script>--}}
{{--        document.getElementById('productForm').addEventListener('submit', async function (e) {--}}
{{--            e.preventDefault();--}}

{{--            // Create a new FormData object--}}
{{--            const formData = new FormData(this);--}}

{{--            // Get the file input for tracking upload progress--}}
{{--            const fileInput = document.getElementById('file').files[0];--}}

{{--            // Use XMLHttpRequest to track upload progress--}}
{{--            const xhr = new XMLHttpRequest();--}}

{{--            // Show progress bar--}}
{{--            document.getElementById('progress-bar-wrapper').classList.remove('hidden');--}}

{{--            // Event listener for progress--}}
{{--            xhr.upload.addEventListener('progress', function (e) {--}}
{{--                if (e.lengthComputable) {--}}
{{--                    const percentComplete = (e.loaded / e.total) * 100;--}}
{{--                    const progressBar = document.getElementById('progress-bar');--}}
{{--                    progressBar.style.width = percentComplete + '%';--}}
{{--                    progressBar.textContent = Math.round(percentComplete) + '%';--}}
{{--                }--}}
{{--            });--}}

{{--            // Define what happens when the upload is done--}}
{{--            xhr.onreadystatechange = function () {--}}
{{--                if (xhr.readyState === XMLHttpRequest.DONE) {--}}
{{--                    if (xhr.status === 200) {--}}
{{--                        document.getElementById('message').innerHTML = '<span class="text-green-500">Termék sikeresen hozzáadva!</span>';--}}
{{--                    } else {--}}
{{--                        document.getElementById('message').innerHTML = '<span class="text-red-500">Hiba történt a fájl feltöltése során!</span>';--}}
{{--                    }--}}
{{--                    setTimeout(function () {--}}
{{--                        document.getElementById('progress-bar-wrapper').classList.add('hidden');--}}
{{--                    }, 2000);--}}
{{--                }--}}
{{--            };--}}

{{--            // Open the request and send the FormData object--}}
{{--            xhr.open('POST', "{{ route('products.store') }}", true);--}}
{{--            xhr.setRequestHeader('X-CSRF-TOKEN', document.querySelector('input[name=_token]').value);--}}

{{--            // Send the FormData with the file and other form data--}}
{{--            xhr.send(formData);--}}
{{--        });--}}
{{--    </script>--}}
</x-app-layout>
