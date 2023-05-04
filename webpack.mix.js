const mix = require('laravel-mix');
const path = require('path');

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

mix.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.setPublicPath('public')
    .sass('resources/sass/candidate/app.scss', 'css/candidate.css')
    .sass('resources/sass/company/app.scss', 'css/company.css')
    .sourceMaps();

mix.webpackConfig({
    // stats: {
    //     children: true,
    // },
    stats: {
        // One of the two if I remember right
        entrypoints: false,
        children: false
     },
});
