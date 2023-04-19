const mix = require('laravel-mix');

mix.postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
]);

mix.js('resources/js/app.js', 'public/js')
    .babel('public/js/app.js', 'public/js/app.js');

