/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Imports the calendar
import 'jquery-ui/ui/widgets/datepicker.js';

// Imports dropzone
window.Dropzone = require('dropzone');
Dropzone.options.courseworkDropzone = {
    maxFilesize: 10, // MB
    renameFile: function(file) {
        return "hello";
    },
    acceptedFiles: ".zip",
    addRemoveLinks: true,
    timeout: 50000
};

/**
 * Adds all additonal javascript files
 */
require('./components/navbar');
require('./components/list');
require('./components/form');