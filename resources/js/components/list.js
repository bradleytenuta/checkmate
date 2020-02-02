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