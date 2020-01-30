$(document).ready(function(){

    // Gets all the grid elements and loops through them all, adding masonry.
    var grids = document.getElementsByClassName('grid');
    
    for (var i = 0; i < grids.length; i++) {
        new Masonry( grids[i], {
            // options
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            percentPosition: true
        });
    }
});

// Creates nav dropdown onclick functions.
var userDropdown = $('#navbar-user-dropdown');
var adminDropdown = $('#navbar-admin-dropdown');
$("#navbar-user-button").click(function() {
    openNavDropDown(userDropdown);
});
$("#navbar-admin-button").click(function() {
    openNavDropDown(adminDropdown);
});

function openNavDropDown(dropdown) {

    // Checks to see if the specific dropdown is already open.
    var isOpen = false;
    if (dropdown.css("display") == "block") {
        isOpen = true;
    }

    // hides all dropdowns.
    userDropdown.css("display", "none");
    adminDropdown.css("display", "none");

    // Opens the dropdown if it wasnt open to begin with.
    if (!isOpen) {
        dropdown.css("display", "block");
    }
}