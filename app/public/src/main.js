// Importing styles
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css';
import $ from 'jquery';

// Tooltip initialization
tippy('[data-tippy-content]');

// Toggle sidebar
$(document).ready(function() {
    $("#aside-toggle").click(function() {
        $("#logo-sidebar").toggle();
    });
});

// Mode Thèmes (Dark/Light)
const modeToggle = document.getElementById('modeToggle');
const icon = document.getElementById('icon');

modeToggle.addEventListener('click', function() {
  if (icon.classList.contains('fa-sun')) {
    icon.classList.remove('fa-sun');
    icon.classList.add('fa-moon');
  } else {
    icon.classList.remove('fa-moon');
    icon.classList.add('fa-sun');
  }
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
