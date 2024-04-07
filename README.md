# CDAW

Lacer le projet : 

- php artisan serve
- npm run dev
- laravel-echo-server start
- redis-clo monitor

Importer les migrations :

- php artisan migrate

Importer la base de donnée :

- php artisan db:seed

Le site est constitué de 5 pages principal : 

- Home page
- Les amis
- Jouer
- Administration
- Profile

La page administrateur n'est pas disponible pour les utilisateurs non admin

Les parties privées ne sont disponibles uniquement si l'hôte est amis avec vous.