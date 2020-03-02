window.openDropDown = function openDropDown(dropdownId) {
    // If the dropdown is open, then close it.
    if ($('#' + dropdownId).css("display") == "block") {
        $('#' + dropdownId).css("display", "none");
    } else {
        $('#' + dropdownId).css("display", "block");
    }
}