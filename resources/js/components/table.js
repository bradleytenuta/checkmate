$(document).ready(function(){

    // Gets the width of the table id cell and sets the width of its header to match it.
    var cellWidth = $('#create-module-assign-container .create-module-cell-id').width();
    $('#create-module-assign-header .create-module-cell-id').width(cellWidth);
});

/**
 * This adds a click function to every radio input on the page.
 * It removes the checked property from the radio if the radio is already checked.
 */
$('input[type="radio"]').click(function() {
    var checkedClass = 'create-module-input-checked';

    // If the radio is already checked.
    if ($(this).hasClass(checkedClass)) {
        $(this).prop('checked', false);
        $(this).removeClass(checkedClass)

    // If the radio is not checked.
    } else {
        $(this).addClass(checkedClass);
    }
});

/**
 * This function is called whenever the user types in the search box of the table.
 */
window.searchForUser = function searchForUser() {
    // Searches through the id's for the same text
    $('.create-module-cell-id-inner').each(function(index) {

        // TODO: Remove all background colours from here

        if($(this).text() == $('#create-module-search').val()) {

            // Gets the height of where the elem would be in the list.
            var heightOfElem = $(this).height() * index + 1;
            $('#create-module-assign-container').animate({
                scrollTop: heightOfElem
            },500);

            // TODO: Add background color to the row.

            return false;
        }
    });

    // Searches through the names for the same text
    $('.create-module-cell-name-inner').each(function() {
        if($(this).text() == $('#create-module-search').val()) {

            // Gets the height of where the elem would be in the list.
            var heightOfElem = $(this).height() * index + 1;
            $('#create-module-assign-container').animate({
                scrollTop: heightOfElem
            },500);

            // TODO: Add background color to the row.

            return false;
        }
    });
}

/**
 * The map used for table selection functions below
 */
var map = new Map();

/**
 * loops through all the inputs and checks all
 * the ones that have a value that matches the paramter.
 * If they have recently all been checked, then uncheck them instead.
 */
window.tableSelectAll = function tableSelectAll(roleType) {
    // If the key is true, then uncheck all the values of the role type.
    if (map.get(roleType)) {
        $('.form-check-input').each(function() {
            tableCheck(this, roleType, false);
        });
        map.set(roleType, false);

    // If the key is false then check all the values of the role type.
    } else if (!map.get(roleType)) {
        $('.form-check-input').each(function() {
            tableCheck(this, roleType, true);
        });
        map.set(roleType, true);
    }
}

/**
 * Checks or unchecks an input in the table based on the inputs provided.
 */
window.tableCheck = function tableCheck(inputElem, roleType, bool) {
    // Only checks the inputs of the right role type.
    if ($(inputElem).attr("value") == roleType) {
        $(inputElem).prop('checked', bool);
    }
}