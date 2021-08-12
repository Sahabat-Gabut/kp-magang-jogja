const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');

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

mix.ts('resources/js/app.js', 'public/js').react()
   .sass('resources/sass/app.sass', 'public/css')
   .options({
       processCssUrls: false,
       postCss: [ tailwindcss('tailwind.config.js') ],
   })
   .sourceMaps()
   .webpackConfig(require('./webpack.config'))
   .disableNotifications();

if(mix.inProduction()) {
    mix.version();
}

mix.browserSync('magang.test');
