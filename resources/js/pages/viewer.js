$(document).ready(function() {
    adjustNumberContainerWidth();
});

/**
 * Adjusts the width of the number containers to match the width of the
 * last container.
 */
window.adjustNumberContainerWidth = function adjustNumberContainerWidth() {
    // Loops through all the number containers and
    var maxWidth = $('.viewer-number-container').last().width();

    // Sets the width of all the number containers
    $('.viewer-number-container').width(maxWidth);
}