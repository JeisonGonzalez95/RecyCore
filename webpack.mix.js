const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')
    .postCss('resources/css/body.css', 'public/css');

// Minificar archivos JS y CSS en producción
if (mix.inProduction()) {
    mix.minify('public/js/app.js')
        .minify('public/css/app.css')
        .minify('public/css/body.css');
}

// Habilitar versionado para el cache busting
mix.version();
