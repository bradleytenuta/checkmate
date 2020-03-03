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

    // Opens or closes the container based on
    if ($(leftContainer).hasClass("closed")) {
        // Removes the class.
        $(leftContainer).removeClass("closed");

        // Gets the image src.
        var imageSrc = $(button).children().first().attr("src");

        // Replace with new sub string.
        imageSrc = imageSrc.replace("right", "left");

        // Sets the attribute.
        $(button).children().first().attr("src", imageSrc);

        // Opens the left main container
        $(leftContainer).css("width", "360px");
        $(leftContainerMain).css("display", "block");

    } else {
        // Adds the class.
        $(leftContainer).addClass("closed");

        // Gets the image src.
        var imageSrc = $(button).children().first().attr("src");

        // Replace with new sub string.
        imageSrc = imageSrc.replace("left", "right");

        // Sets the attribute.
        $(button).children().first().attr("src", imageSrc);

        // closes the left main container
        $(leftContainer).css("width", "auto");
        $(leftContainerMain).css("display", "none");
    }
    

});