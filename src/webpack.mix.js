const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/pages/viewer.js', 'public/js/pages')
   .js('resources/js/components/form.js', 'public/js/components')
   .js('resources/js/components/list.js', 'public/js/components')
   .js('resources/js/components/navbar.js', 'public/js/components')
   .js('resources/js/components/page.js', 'public/js/components')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/pages/login.scss', 'public/css/pages')
   .sass('resources/sass/pages/viewer.scss', 'public/css/pages');
