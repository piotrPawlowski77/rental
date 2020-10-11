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
    .js('resources/js/bootstrap.min.js', 'public/js')
    .js('resources/js/jquery-3.4.1.min.js', 'public/js')
    .js('resources/js/jquery.scrollTo.min.js', 'public/js')
    .js('resources/js/navbar_sticky.js', 'public/js')
    .js('resources/js/scroll_up.js', 'public/js')

    .sass('resources/sass/app.scss', 'public/css')
    .css('resources/css/bootstrap.min.css', 'public/css')
    .sass('resources/css/fontello.scss', 'public/css')
    .sass('resources/css/fontello-codes.scss', 'public/css')
    .sass('resources/css/fontello-embedded.scss', 'public/css')
    .sass('resources/css/fontello-ie7.scss', 'public/css')
    .sass('resources/css/fontello-ie7-codes.scss', 'public/css')
    .sass('resources/css/Footer-with-button-logo.scss', 'public/css')
    .sass('resources/css/frontend_galeria.scss', 'public/css')

    .sass('resources/css/frontend_index.scss', 'public/css')

    .sass('resources/css/frontend_index_form.scss', 'public/css')
    .sass('resources/css/frontend_kontakt.scss', 'public/css')
    .sass('resources/css/frontend_o_firmie.scss', 'public/css')
    .sass('resources/css/frontend_oferta.scss', 'public/css')

    ;

mix.setResourceRoot('../');
