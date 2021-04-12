const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const MinifyHtmlWebpackPlugin = require('minify-html-webpack-plugin');

mix
.js('resources/js/guest.js', 'public/assets/js')
.js('resources/js/app.js','public/assets/js')
.sass('resources/sass/guest.scss', 'public/assets/css')
.sass('resources/sass/app.scss', 'public/assets/css')
.options({
    processCssUrls: false,
    postCss: [ tailwindcss('tailwind.config.js') ],
});


if (mix.inProduction()) {
    mix
    .version()
    .webpackConfig({
        plugins: [
            new MinifyHtmlWebpackPlugin({
                src: './storage/framework/views',
                ignoreFileNameRegex: /\.(gitignore)$/,
                rules: {
                    collapseWhitespace: true,
                    removeAttributeQuotes: true,
                    removeComments: true,
                    minifyJS: true,
                }
            })
        ]
    })
}