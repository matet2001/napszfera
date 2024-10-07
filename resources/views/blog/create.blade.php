<x-app-layout>
    <div class="flex justify-center items-center">
        <div class="w-full max-w-lg p-8 rounded-lg">
            <h1 class="text-2xl font-bold mb-6 text-center">Új Bejegyzés Posztolása</h1>

            <!-- Form -->
            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Post Name -->
                <div class="mb-4">
                    <label for="title" class="block font-semibold mb-2">Poszt Címe:</label>
                    <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded-lg text-black focus:outline-none focus:ring focus:ring-blue-200" required>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="content" class="block font-semibold mb-2">Leírás:</label>
                    <textarea name="content" id="content" class="w-full px-4 py-2 border rounded-lg text-black focus:outline-none focus:ring focus:ring-blue-200" rows="4" required></textarea>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="submit" class="bg-blue-500 text-white font-semibold px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                        Közététel
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

