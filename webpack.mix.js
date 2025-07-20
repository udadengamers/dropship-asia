const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);

mix.js('resources/js/seller.js', 'public/js')
    .postCss('resources/css/seller.css', 'public/css', [
        //
    ]);

mix.js('resources/js/admin.js', 'public/js')
    .postCss('resources/css/admin.css', 'public/css', [
        //
    ]);

mix.js('resources/js/upload.js', 'public/js')
    .postCss('resources/css/upload.css', 'public/css', [
        //
    ]);

mix.js('resources/js/scroll.js', 'public/js')
    .postCss('resources/css/scroll.css', 'public/css', [
        //
    ]);

mix.postCss('resources/css/themes/shop.css', 'public/css');

mix.postCss('resources/css/wallet.css', 'public/css');