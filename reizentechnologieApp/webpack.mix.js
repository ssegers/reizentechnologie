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

mix.setPublicPath('../www');
mix.setResourceRoot('/');
mix.js([
  'resources/js/app.js',
  'node_modules/bootstrap-select/dist/js/bootstrap-select.min.js',
  'node_modules/bootstrap-select/dist/js/i18n/defaults-nl_NL.min.js'
], 'js');
 mix.js('resources/js/dropdown/cascadingDropDownStudyMajors.js', 'js/dropdown');
 mix.js('resources/js/dropdown/cascadingDropDownDestinationAccomodation.js', 'js/dropdown');
 mix.sass('resources/sass/app.scss', 'css');
 mix.copy('resources/datatables/datatables.min.css','../www/css/datatables');
 mix.copy('resources/datatables/datatables.min.js', '../www/js/datatables');
