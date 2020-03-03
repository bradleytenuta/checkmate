/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// Imports the calendar
import 'jquery-ui/ui/widgets/datepicker.js';

/**
 * Adds all additonal javascript files
 */
require('./components/navbar');
require('./components/list');
require('./components/form');
require('./components/page');
require('./pages/viewer');