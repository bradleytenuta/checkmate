window.openNavDropDown = function openNavDropDown(dropdownId) {

    // Checks to see if the specific dropdown is already open.
    var isOpen = false;
    if ($('#' + dropdownId).css("display") == "block") {
        isOpen = true;
    }

    // hides all dropdowns.
    $('.navbar .navbar-dropdown').css("display", "none");

    // Opens the dropdown if it wasnt open to begin with.
    if (!isOpen) {
        $('#' + dropdownId).css("display", "block");
    }
}