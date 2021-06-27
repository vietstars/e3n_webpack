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
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/line-awesome.min.scss', 'public/css')
    .vue();

// theme assets
mix.copyDirectory('resources/theme-assets', 'public/theme-assets');

mix.js('resources/js/*.js', 'public/js').sass('resources/sass/app.scss', 'public/css').version();

if (mix.inProduction()) {
    mix.version();
}
