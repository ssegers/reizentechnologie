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
], 'js')
   .js('resources/js/dropdown/cascadingDropDownStudyMajors.js', 'js/dropdown')
   .sass('resources/sass/app.scss', 'css');