document.addEventListener('DOMContentLoaded', function () {
    // Mobile Menu Toggle
    const openMobileMenuButton = document.getElementById('open-mobile-menu');
    const closeMobileMenuButton = document.getElementById('close-mobile-menu');
    const mobileSidebarPanel = document.getElementById('mobile-sidebar-panel');
    const mobileSidebarContent = document.getElementById('mobile-sidebar-content');
    const mobileBackgroundOverlay = document.getElementById('mobile-background-overlay');

    if (openMobileMenuButton && closeMobileMenuButton && mobileSidebarPanel && mobileSidebarContent && mobileBackgroundOverlay) {
        openMobileMenuButton.addEventListener('click', function () {
            mobileSidebarPanel.classList.remove('hidden');
            setTimeout(function () {
                mobileSidebarContent.classList.remove('translate-x-full');
                mobileSidebarContent.classList.add('translate-x-0');
                mobileBackgroundOverlay.classList.remove('opacity-0');
                mobileBackgroundOverlay.classList.add('opacity-75');
            }, 10);
        });

        closeMobileMenuButton.addEventListener('click', function () {
            mobileSidebarContent.classList.remove('translate-x-0');
            mobileSidebarContent.classList.add('translate-x-full');
            mobileBackgroundOverlay.classList.remove('opacity-75');
            mobileBackgroundOverlay.classList.add('opacity-0');
            setTimeout(function () {
                mobileSidebarPanel.classList.add('hidden');
            }, 500);
        });

    }

    // Function to toggle the profile menu
    function toggleProfileMenu() {
        const profileMenu = document.getElementById('mobile-profile-menu');
        if (profileMenu) {
            profileMenu.classList.toggle('open');
        }
    }

    // Add event listener to the profile menu button
    const profileButton = document.querySelector('button[aria-controls="mobile-profile-menu"]');
    if (profileButton) {
        profileButton.addEventListener('click', toggleProfileMenu);
    }

    // Add event listener to the overlay background to close the menu
    const overlayBackground = document.getElementById('mobile-background-overlay');
    if (overlayBackground) {
        overlayBackground.addEventListener('click', function () {
            document.getElementById('mobile-sidebar-panel').classList.add('hidden');
            overlayBackground.classList.add('opacity-0');
        });
    }

    document.getElementById('mobile-logout-link').addEventListener('click', function(event) {
        event.preventDefault();  // Prevent the default anchor link behavior
        document.getElementById('mobile-logout-form').submit();  // Trigger the form submission
    });
});
