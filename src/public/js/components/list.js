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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/list.js":
/*!*****************************************!*\
  !*** ./resources/js/components/list.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(window).on('load', function () {
  buildMasonary();
});

window.toggleCourseworkDropdown = function toggleCourseworkDropdown(toggleButton) {
  // Next sibling to the button
  var sibling = $(toggleButton).next();
  var open_time = 250;
  var close_time = 500; // Gets the current height.

  var curHeight = sibling.height(); // Gets the height for 'auto' then sets the height back to current height.

  var autoHeight = sibling.css('height', 'auto').height();
  sibling.height(curHeight); // if the height is 0, then extend the height of the container.

  if (sibling.height() == 0) {
    // Animates the height to auto in miniseconds.
    sibling.stop().animate({
      height: autoHeight
    }, open_time, function () {
      buildMasonary();
    });
  } else {
    // Animates the height to 0, effectivly closing the container.
    sibling.stop().animate({
      height: 0
    }, close_time, function () {
      buildMasonary();
    });
  }
};

window.buildMasonary = function buildMasonary() {
  $('.grid').masonry({
    // options
    itemSelector: '.grid-item',
    columnWidth: '.grid-sizer',
    percentPosition: true
  });
};

window.toggleModuleFilter = function toggleModuleFilter(filterButton, filterOption) {
  // Updates the filter buttons
  updateFilterButtons(filterButton); // Gets all the grid items

  var griditems = $('.grid-item'); // Show all

  if (filterOption == 0) {
    griditems.each(function () {
      $(this).css('display', 'block');
    }); // Show open
  } else if (filterOption == 1) {
    griditems.each(function () {
      // If there is at least one 'card-open' class, inside the list of courseworks, then show the module.
      if ($(this).find('.list-module-coursework-container .card-open').length > 0) {
        $(this).css('display', 'block');
      } else {
        $(this).css('display', 'none');
      }
    }); // Show closed
  } else if (filterOption == 2) {
    griditems.each(function () {
      // If there is no 'card-open' class, inside the list of courseworks, then show the module.
      if ($(this).find('.list-module-coursework-container .card-open').length == 0) {
        $(this).css('display', 'block');
      } else {
        $(this).css('display', 'none');
      }
    });
  } // Rebuilds the masonary.


  buildMasonary();
};

window.toggleCourseworkFilter = function toggleCourseworkFilter(filterButton, filterOption) {
  // Updates the filter buttons
  updateFilterButtons(filterButton); // Gets all the grid items

  var griditems = $('.grid-item'); // Show all

  if (filterOption == 0) {
    griditems.each(function () {
      $(this).css('display', 'block');
    }); // Show open
  } else if (filterOption == 1) {
    griditems.each(function () {
      // If the coursework has the 'card-open' class then show it.
      if ($(this).find('.card-open').length > 0) {
        $(this).css('display', 'block');
      } else {
        $(this).css('display', 'none');
      }
    }); // Show closed
  } else if (filterOption == 2) {
    griditems.each(function () {
      // If the coursework does not have the 'card-open' class then show it.
      if ($(this).find('.card-open').length == 0) {
        $(this).css('display', 'block');
      } else {
        $(this).css('display', 'none');
      }
    });
  } // Rebuilds the masonary.


  buildMasonary();
};

window.updateFilterButtons = function updateFilterButtons(filterButton) {
  // Gets all the filter input options and unchecks them.
  $('#list-filter-container label').removeClass("active"); // Checks the filter input that was clicked.

  $('#' + filterButton.id).parent().addClass("active");
};

/***/ }),

/***/ 3:
/*!***********************************************!*\
  !*** multi ./resources/js/components/list.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /var/www/html/resources/js/components/list.js */"./resources/js/components/list.js");


/***/ })

/******/ });