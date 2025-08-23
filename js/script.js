    // Toggle the navigation menu on small screens
    document.getElementById('menuToggle').addEventListener('click', function() {
        const navLinks = document.getElementById('navLinks');
        navLinks.classList.toggle('active');
    });
    // Close the navigation menu when a link is clicked
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            const navLinksContainer = document.getElementById('navLinks');
            if (navLinksContainer.classList.contains('active')) {
                navLinksContainer.classList.remove('active');
            }
        });
    });

    // Tab functionality for the content sections
    document.addEventListener('DOMContentLoaded', function() {
        const tabs = document.querySelectorAll('.tab-item');
        const panels = document.querySelectorAll('.content-panel');

        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs and panels
                tabs.forEach(t => t.classList.remove('active'));
                panels.forEach(p => p.classList.remove('active'));

                // Add active class to clicked tab and corresponding panel
                this.classList.add('active');
                const activePanel = document.getElementById(this.dataset.tab);
                activePanel.classList.add('active');
            });
        });
    });
    

