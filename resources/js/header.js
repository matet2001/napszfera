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

        // Close mobile menu if clicking outside
        document.addEventListener('click', function (event) {
            if (!openMobileMenuButton.contains(event.target) && !mobileSidebarPanel.contains(event.target)) {
                mobileSidebarContent.classList.remove('translate-x-0');
                mobileSidebarContent.classList.add('translate-x-full');
                mobileBackgroundOverlay.classList.remove('opacity-75');
                mobileBackgroundOverlay.classList.add('opacity-0');
                setTimeout(function () {
                    mobileSidebarPanel.classList.add('hidden');
                }, 500);
            }
        });

        // Product sub-menu toggle
        const productButton = document.querySelector('[aria-controls="mobile-disclosure-1"]');
        const productSubMenu = document.getElementById('mobile-disclosure-1');

        if (productButton && productSubMenu) {
            productButton.addEventListener('click', function() {
                const expanded = productButton.getAttribute('aria-expanded') === 'true';
                productButton.setAttribute('aria-expanded', !expanded);
                productSubMenu.classList.toggle('hidden');
            });
        }
    }

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
