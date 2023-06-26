
// Animation for the tooltip
tippy('[data-tippy-content]');


// Animation for the sidebar
$(document).ready(function() {
    $("#aside-toggle").click(function() {
        $("#logo-sidebar").toggle();
    });
});