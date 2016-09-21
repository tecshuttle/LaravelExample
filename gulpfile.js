var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    mix.styles([
        '../bootstrap/css/bootstrap.min.css'
    ]);
});

elixir(function (mix) {
    mix.scripts([
        'jquery.min.js',
        '../bootstrap/js/bootstrap.min.js'
    ]);
});

elixir(function (mix) {
    mix.version(['css/all.css', 'js/all.js']);
});