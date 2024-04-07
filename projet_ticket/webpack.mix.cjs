const mix = require('laravel-mix');



// Compilation des fichiers CSS
mix.combine(
    [
        'resources/css/app.css',
        // Ajoutez d'autres chemins de fichiers CSS ici si nécessaire
    ],
    'public/css/all.css' // Spécifiez le chemin complet du fichier de sortie CSS
);

// Compilation des fichiers JavaScript

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/jeu.js', 'public/js')
   .js('resources/js/websocket.js', 'public/js')
   .babelConfig({
      presets: [
         '@babel/preset-env',
      ],
   });
