/**
 * This function is called whenever the navbar element is hovered on.
 * This changes the image of the navbar item to one with colour.
 * @param {*} element 
 */
function hover(element) {

    // Gets the attribute value
    var imageTag = $(element).children();
    var srcValue = $(imageTag).attr('src');

    // Replaces '.png' with '-active.png' and updates the attribute.
    if (!(srcValue.endsWith("-active.png"))) {
        $(imageTag).attr('src', srcValue.replace('.png', "-active.png"));
    }
}

/**
 * This function is called whenever the navbar element is no longer hovered on.
 * This reverts the image changes back to the default image.
 * @param {*} element 
 */
function unhover(element) {

    // Gets the attribute value
    var imageTag = $(element).children();
    var srcValue = $(imageTag).attr('src');

    // Replaces '.png' with '-active.png' and updates the attribute.
    if (srcValue.endsWith("-active.png")) {
        $(imageTag).attr('src', srcValue.replace("-active.png", '.png'));
    }
}