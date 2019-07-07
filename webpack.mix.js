const mix = require('laravel-mix');
require('laravel-mix-tailwind');

mix
  .sass('resources/sass/app.scss', 'public/css')
  .js('resources/js/app.js', 'public/js')
  .tailwind();
