/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/pages/viewer.js":
/*!**************************************!*\
  !*** ./resources/js/pages/viewer.js ***!
  \**************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/**
 * This fucntion creates the open close slide used for mobile devices.
 */
$('#viewer-left-container-menu-button').click(function () {
  // Gets the button.
  var button = $('#viewer-left-container-menu-button');
  var leftContainer = $('#viewer-left-container');
  var leftContainerMain = $('#viewer-left-container-main'); // Check what image is currently displayed. This tells us if its open or closed.

  var imageSrc = $(button).children().first().attr("src"); // Returns '-1' if sub string not found.

  if (imageSrc.toLowerCase().indexOf("right") >= 0) {
    // Replace with new sub string.
    imageSrc = imageSrc.replace("right", "left"); // Opens the left main container

    $(leftContainerMain).css("display", "block");
    $(leftContainer).css("min-width", "100%");
  } else {
    // Replace with new sub string.
    imageSrc = imageSrc.replace("left", "right"); // Opens the left main container

    $(leftContainerMain).css("display", "none");
    $(leftContainer).css("min-width", "auto");
  } // Sets the attribute.


  $(button).children().first().attr("src", imageSrc);
});
/**
 * This function makes an inline comment. This function is called when the user
 * clicks a line of code.
 */

window.makeLineComment = function makeLineComment($lineContainerId) {
  // Gets the line comments container
  var lineCommentContainer = $('#line-comments-container-table'); // Create a HTML element.

  var htmlElementString = "<tr class=\"comment-container\" id=\"comment-container-" + $lineContainerId + "\"><td class=\"comment-input-container\"><p>" + $lineContainerId + "</p><input type=\"text\" class=\"form-control\" name=\"" + $lineContainerId + "\"></td><td><button type=\"button\" class=\"checkmate-button\" onclick=\"deleteLineComment(" + $lineContainerId + ")\"><img src=\"/storage/images/icon/dropdown-trash.png\" /></button></td></tr>"; // Appends the new element to the end of the line comments container.

  $(lineCommentContainer).append(htmlElementString); // Give the text box focus.

  $("#line-comment-" + $lineContainerId).focus();
};
/**
 * This function deletes an inline comment.
 */


window.deleteLineComment = function deleteLineComment($lineContainerId) {
  // Finds the comment container with the given id.
  var commentContainer = $('#comment-container-' + $lineContainerId); // Deletes the comment container.

  commentContainer.remove();
};

/***/ }),

/***/ 1:
/*!********************************************!*\
  !*** multi ./resources/js/pages/viewer.js ***!
  \********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/resources/js/pages/viewer.js */"./resources/js/pages/viewer.js");


/***/ })

/******/ });