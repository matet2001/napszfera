document.addEventListener('DOMContentLoaded', function () {
        // Profile Menu Toggle
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenuDropdown = document.getElementById('user-menu-dropdown');

    if (userMenuButton && userMenuDropdown) {
        userMenuButton.addEventListener('click', function () {
            const isVisible = !userMenuDropdown.classList.contains('hidden');
            if (isVisible) {
                // Close menu
                userMenuDropdown.classList.add('opacity-0', 'scale-95');
                userMenuDropdown.classList.remove('opacity-100', 'scale-100');
                setTimeout(() => {
                    userMenuDropdown.classList.add('hidden');
                }, 300);
            } else {
                // Open menu
                userMenuDropdown.classList.remove('hidden');
                setTimeout(() => {
                    userMenuDropdown.classList.add('opacity-100', 'scale-100');
                    userMenuDropdown.classList.remove('opacity-0', 'scale-95');
                }, 10);
            }
        });

        // Close profile menu if clicking outside
        document.addEventListener('click', function (event) {
            if (!userMenuButton.contains(event.target) && !userMenuDropdown.contains(event.target)) {
                userMenuDropdown.classList.add('opacity-0', 'scale-95');
                userMenuDropdown.classList.remove('opacity-100', 'scale-100');
                setTimeout(() => {
                    userMenuDropdown.classList.add('hidden');
                }, 300);
            }
        });
    }

    document.getElementById('logout-link').addEventListener('click', function(event) {
        event.preventDefault();  // Prevent the default anchor link behavior
        document.getElementById('logout-form').submit();  // Trigger the form submission
    });
});
