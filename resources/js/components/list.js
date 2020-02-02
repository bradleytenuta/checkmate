$(window).on('load', function() {
    buildMasonary();
});

window.toggleCourseworkDropdown = function toggleCourseworkDropdown(toggleButton) {
    // Next sibling to the button
    var sibling = $(toggleButton).next();
    var open_time = 250;
    var close_time = 500;

    // Gets the current height.
    var curHeight = sibling.height();

    // Gets the height for 'auto' then sets the height back to current height.
    var autoHeight = sibling.css('height', 'auto').height();
    sibling.height(curHeight);

    // if the height is 0, then extend the height of the container.
    if (sibling.height() == 0) {

        // Animates the height to auto in miniseconds.
        sibling.stop().animate({ height: autoHeight }, open_time, function() {
            buildMasonary();
        });
    } else {

        // Animates the height to 0, effectivly closing the container.
        sibling.stop().animate({ height: 0 }, close_time, function() {
            buildMasonary();
        });
    }
}

window.buildMasonary = function buildMasonary() {
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: '.grid-sizer',
        percentPosition: true
    });
}

window.toggleListFilter = function toggleListFilter(filterButton, filterOption) {
    // Gets all the filter input options and unchecks them.
    $('#list-filter-container label').removeClass("active");

    // Checks the filter input that was clicked.
    $('#' + filterButton.id).parent().addClass("active");

    // Gets all the grid items
    var griditems = $('.grid-item');

    // Show all
    if (filterOption == 0) {
        griditems.each(function() {
            $(this).css('display', 'block');
        });

    // Show open
    } else if (filterOption == 1) {
        griditems.each(function() {

            // If there is no 'card-open' class, then hide.
            if ($(this).find('.card-open').length == 0) {
                $(this).css('display', 'none');
            } else {
                $(this).css('display', 'block');
            }
        });

    // Show closed
    } else if (filterOption == 2) {
        griditems.each(function() {

            // If there is no 'card-open' class, then show.
            if ($(this).find('.card-open').length == 0) {
                $(this).css('display', 'block');
            } else {
                $(this).css('display', 'none');
            }
        });
    }

    // Rebuilds the masonary.
    buildMasonary();
}