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

$('#viewer-left-container-menu-button').click(function(){

    // Gets the button.
    var button = $('#viewer-left-container-menu-button');
    var leftContainer = $('#viewer-left-container');
    var leftContainerMain = $('#viewer-left-container-main')

    // Check what image is currently displayed. This tells us if its open or closed.
    var imageSrc = $(button).children().first().attr("src");
    // Returns '-1' if sub string not found.
    if (imageSrc.toLowerCase().indexOf("right") >= 0) {
        // Replace with new sub string.
        imageSrc = imageSrc.replace("right", "left");
        // Opens the left main container
        $(leftContainerMain).css("display", "block");
        $(leftContainer).css("min-width", "100%");
    } else {
        // Replace with new sub string.
        imageSrc = imageSrc.replace("left", "right");
        // Opens the left main container
        $(leftContainerMain).css("display", "none");
        $(leftContainer).css("min-width", "auto");
    }

    // Sets the attribute.
    $(button).children().first().attr("src", imageSrc);
});