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

mix
    // .js('resources/js/app.js', 'public/js');
    // .js('resources/js/core-ui.js', 'public/js');
    // .js('resources/js/codemirror.js', 'public/js')
//    .sass('resources/sass/style.scss', 'public/css');
//    .sass('resources/sass/codemirror.scss', 'public/css');
//    .sass('resources/sass/core-ui.scss', 'public/css');
//    .sass('resources/sass/system-admin.scss', 'public/css');
   .sass('resources/sass/wintermin.scss', 'public/css');
// .scripts('resources/js/data-grid.js', 'public/js/data-grid.js');
