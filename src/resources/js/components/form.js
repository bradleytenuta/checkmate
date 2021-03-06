$(document).ready(function() {
    // Aligns the width of the table header cells to match the width of the content header cells.
    alignHeaderCells();

    // Finds a element with the given ID and adds the JQueryUI calendar to it.
    // This is so users can select a date rather than typing it.
    $("#deadline").datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd"
    });
    $("#start_date").datepicker({
        minDate: 0,
        dateFormat: "yy-mm-dd"
    });
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
 * This function goes through all the header cells and adjusts their cell width
 * to match the content cells in the other table. This is so they line up correctly.
 */
window.alignHeaderCells = function alignHeaderCells() {
    // Gets all the cells from a header row and a content row.
    var headerCells = $('.header-table-row').first().children("th");
    var contentCells = $('.content-table-row').first().children("td");

    // Loops through all the content cells, gets their widths and assigns it to the header cells.
    $(contentCells).each(function(index) {
        $(headerCells[index]).outerWidth($(this).outerWidth());
    });
}

/**
 * This function is called whenever the user types in the search box of the table.
 */
window.searchForUser = function searchForUser() {
    // Searches through the id's for the same text
    // Or searches through the names for the same text
    $('.create-module-cell-id-inner, .create-module-cell-name-inner').each(function(index) {

        // Clears all rows to transparent backgrounds.
        $('#create-module-assign-container tr').css('background-color', 'transparent');

        var iteratingString = $(this).text().toLowerCase().trim();
        var searchString = $('#create-module-search').val().toLowerCase().trim();

        if(iteratingString == searchString || iteratingString.includes(searchString)) {

            // Gets the height of where the elem would be in the list.
            // We add one to the index so it doesnt start at 0 then 
            // divide it by 2 as it goes through the name and id on each row.
            var heightOfElem = $(this).height() * ((index + 1) / 2);
            $('#create-module-assign-container').animate({
                scrollTop: heightOfElem
            },500);

            $(this).parent().parent().parent().css('background-color', 'yellow')

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