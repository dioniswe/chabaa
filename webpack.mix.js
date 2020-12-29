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
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/@fortawesome/fontawesome-free', 'public/vendor/font-awesome/')
    .copy('node_modules/video.js/dist', 'public/vendor/video.js/')
    .copy('node_modules/photoswipe/dist', 'public/vendor/photoswipe/')
    .copy('node_modules/bootstrap/dist', 'public/vendor/bootstrap/');
