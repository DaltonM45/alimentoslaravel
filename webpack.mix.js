const mix = require('laravel-mix');



mix.js('resources/js/app.js', 'public/js')
.styles(['resources/plantilla/css/style.css'] , 'public/css/app.css')
.scripts([
    'resources/plantilla/js/sweetalert.min.js',
], 'public/js/plantilla.js')



mix.disableNotifications();






  
