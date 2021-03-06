/**
 * This fucntion creates the open close slide used for mobile devices.
 */
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

/**
 * This function makes an inline comment. This function is called when the user
 * clicks a line of code.
 */
window.makeLineComment = function makeLineComment($lineContainerId) {
    // Gets the line comments container
    var lineCommentContainer = $('#line-comments-container-table');

    // Create a HTML element.
    var htmlElementString = "<tr class=\"comment-container\" id=\"comment-container-" + $lineContainerId
        + "\"><td class=\"comment-input-container\"><p>" + $lineContainerId
        + "</p><input type=\"text\" class=\"form-control\" name=\"" + $lineContainerId
        + "\"></td><td><button type=\"button\" class=\"checkmate-button\" onclick=\"deleteLineComment(" + $lineContainerId
        + ")\"><img src=\"/storage/images/icon/dropdown-trash.png\" /></button></td></tr>"

    // Appends the new element to the end of the line comments container.
    $(lineCommentContainer).append(htmlElementString);

    // Give the text box focus.
    $("#line-comment-" + $lineContainerId).focus();
};

/**
 * This function deletes an inline comment.
 */
window.deleteLineComment = function deleteLineComment($lineContainerId) {
    // Finds the comment container with the given id.
    var commentContainer = $('#comment-container-' + $lineContainerId);

    // Deletes the comment container.
    commentContainer.remove();
}