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
/******/ 	return __webpack_require__(__webpack_require__.s = 2);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/form.js":
/*!*****************************************!*\
  !*** ./resources/js/components/form.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(document).ready(function () {
  // Aligns the width of the table header cells to match the width of the content header cells.
  alignHeaderCells(); // Finds a element with the given ID and adds the JQueryUI calendar to it.
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

$('input[type="radio"]').click(function () {
  var checkedClass = 'create-module-input-checked'; // If the radio is already checked.

  if ($(this).hasClass(checkedClass)) {
    $(this).prop('checked', false);
    $(this).removeClass(checkedClass); // If the radio is not checked.
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
  var contentCells = $('.content-table-row').first().children("td"); // Loops through all the content cells, gets their widths and assigns it to the header cells.

  $(contentCells).each(function (index) {
    $(headerCells[index]).outerWidth($(this).outerWidth());
  });
};
/**
 * This function is called whenever the user types in the search box of the table.
 */


window.searchForUser = function searchForUser() {
  // Searches through the id's for the same text
  // Or searches through the names for the same text
  $('.create-module-cell-id-inner, .create-module-cell-name-inner').each(function (index) {
    // Clears all rows to transparent backgrounds.
    $('#create-module-assign-container tr').css('background-color', 'transparent');
    var iteratingString = $(this).text().toLowerCase().trim();
    var searchString = $('#create-module-search').val().toLowerCase().trim();

    if (iteratingString == searchString || iteratingString.includes(searchString)) {
      // Gets the height of where the elem would be in the list.
      // We add one to the index so it doesnt start at 0 then 
      // divide it by 2 as it goes through the name and id on each row.
      var heightOfElem = $(this).height() * ((index + 1) / 2);
      $('#create-module-assign-container').animate({
        scrollTop: heightOfElem
      }, 500);
      $(this).parent().parent().parent().css('background-color', 'yellow');
      return false;
    }
  });
};
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
    $('.form-check-input').each(function () {
      tableCheck(this, roleType, false);
    });
    map.set(roleType, false); // If the key is false then check all the values of the role type.
  } else if (!map.get(roleType)) {
    $('.form-check-input').each(function () {
      tableCheck(this, roleType, true);
    });
    map.set(roleType, true);
  }
};
/**
 * Checks or unchecks an input in the table based on the inputs provided.
 */


window.tableCheck = function tableCheck(inputElem, roleType, bool) {
  // Only checks the inputs of the right role type.
  if ($(inputElem).attr("value") == roleType) {
    $(inputElem).prop('checked', bool);
  }
};

/***/ }),

/***/ 2:
/*!***********************************************!*\
  !*** multi ./resources/js/components/form.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/resources/js/components/form.js */"./resources/js/components/form.js");


/***/ })

/******/ });