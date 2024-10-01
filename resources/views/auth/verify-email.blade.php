<x-app-layout>
    <div class="flex flex-col items-center justify-center" style="height: 50vh;">
        <div class="max-w-md w-full p-8 rounded-lg shadow-md border border-white mt-6 flex flex-col space-y-6">
            <h1 class="text-3xl font-semibold text-white text-center">Köszönjük a regisztrációt!</h1>
            <p class="text-center mt-4">
                Mielőtt elkezdené, kérjük, erősítse meg e-mail címét az e-mailben található linkre kattintva, amelyet épp most küldtünk Önnek! Ha nem kapta meg az e-mailt, szívesen elküldjük újra.
            </p>

            <form method="POST" action="{{ route('verification.send') }}" id="verificationForm">
                @csrf
                <button type="submit" id="verificationButton" class="sm:mt-6 block w-full rounded-md text-white bg-primary px-5 py-2.5 text-center text-sm font-medium hover:bg-accent hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500">
                    Megerősítő e-mail újraküldése
                </button>
            </form>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600 text-center">
                    Új megerősítő linket küldtünk a regisztráció során megadott e-mail címére.
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 font-medium text-sm text-red-600 text-center">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Contact Support Button -->
            <a href="{{ route('contact') }}" class="sm:mt-6 block w-full rounded-md text-white bg-blue-500 px-5 py-2.5 text-center text-sm font-medium hover:bg-blue-200 hover:text-black focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all duration-500">
                Kapcsolatfelvétel
            </a>
        </div>
    </div>

    <script>
        const button = document.getElementById('verificationButton');

        // Check local storage for cooldown
        const cooldownTime = localStorage.getItem('verificationCooldown');
        if (cooldownTime) {
            const timeRemaining = cooldownTime - Date.now();
            if (timeRemaining > 0) {
                // Disable button and show remaining time
                button.disabled = true;
                updateButtonWithCountdown(timeRemaining); // Update button text with countdown
                setTimeout(() => {
                    button.disabled = false;
                    button.innerText = 'Megerősítő e-mail újraküldése';
                    localStorage.removeItem('verificationCooldown'); // Clear cooldown
                }, timeRemaining);
            }
        }

        // Form submission event
        document.getElementById('verificationForm').onsubmit = function() {
            // Set cooldown for the button (e.g., 30 seconds)
            const cooldownDuration = 30000; // 30 seconds
            localStorage.setItem('verificationCooldown', Date.now() + cooldownDuration);

            // Disable the button for the cooldown period
            button.disabled = true;
            updateButtonWithCountdown(cooldownDuration);

            // Countdown function
            let remainingTime = cooldownDuration / 1000; // Convert to seconds
            const countdownInterval = setInterval(() => {
                remainingTime--;
                if (remainingTime <= 0) {
                    clearInterval(countdownInterval);
                    button.disabled = false;
                    button.innerText = 'Megerősítő e-mail újraküldése'; // Reset button text
                } else {
                    button.innerText = `Kérjük, várjon ${remainingTime} másodpercet...`;
                }
            }, 1000); // Update every second

            return true; // Continue form submission
        };

        // Function to update the button with the countdown
        function updateButtonWithCountdown(timeRemaining) {
            let remainingTime = Math.ceil(timeRemaining / 1000); // Convert milliseconds to seconds
            const countdownInterval = setInterval(() => {
                if (remainingTime <= 0) {
                    clearInterval(countdownInterval);
                } else {
                    button.innerText = `Kérjük, várjon ${remainingTime--} másodpercet...`;
                }
            }, 1000); // Update every second
        }
    </script>

</x-app-layout>
