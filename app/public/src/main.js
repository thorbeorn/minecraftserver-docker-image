// Importing styles
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import $ from 'jquery';

// Tooltip initialization
tippy('[data-tippy-content]');

// Toggle sidebar
$(document).ready(function() {
    $("#aside-toggle").click(function() {
        let logoSidebar = $("#logo-sidebar");
        if (logoSidebar.is(":visible")) {
            logoSidebar.animate({width: 'toggle', opacity: 0}, 500);
        } else {
            logoSidebar.animate({width: 'toggle', opacity: 1}, 500);
        }
    });
});


// Mode Thèmes (Dark/Light)
window.onload = () => {
    console.log("Page loaded");
    // Load theme state from localStorage
    if (localStorage.getItem('darkMode') === 'true') {
        console.log("Dark mode detected in localStorage");
        toggleDarkMode();
    }
};

const toggleDarkMode = () => {
    const logo = document.getElementById('logo');
    const icon = document.getElementById('icon');

    console.log("Toggling dark mode");
    
    if (document.documentElement.classList.toggle('dark')) {
        console.log("Switching to dark mode");
        // Change logo and icon for dark mode
        logo.src = "public/assets/img/logo_solo.png";
        icon.classList.replace("fa-moon", "fa-sun");

        // Save theme state to localStorage
        localStorage.setItem('darkMode', 'true');

    } else {
        console.log("Switching to light mode");
        // Change logo and icon back for light mode
        logo.src = "public/assets/img/logo_soloblack.png";
        icon.classList.replace("fa-sun", "fa-moon");

        // Save theme state to localStorage
        localStorage.setItem('darkMode', 'false');
    }
};

document.getElementById('modeToggle').addEventListener('click', () => {
    console.log("Mode toggle clicked");
    toggleDarkMode();
});




// Dynamic import of ramChart.js, cpuChart.js, and networkChart.js

if (document.getElementById('ram-performance-chart')) {
    import('./ramChart.js').then(({ default: createRamChart }) => {
        createRamChart();
    }).catch(error => console.log('An error occurred while loading the component:', error));
}

if (document.getElementById('cpu-performance-chart')) {
    import('./cpuChart.js').then(({ default: createCpuChart }) => {
        createCpuChart();
    }).catch(error => console.log('An error occurred while loading the component:', error));
}

if (document.getElementById('network-chart')) {
    import('./networkChart.js').then(({ default: createNetworkChart }) => {
        createNetworkChart();
    }).catch(error => console.log('An error occurred while loading the component:', error));
}
