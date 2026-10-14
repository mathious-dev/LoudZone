# **LoudZone**



C'est une plateforme e-commerce qui va permettre au groupe de rock LoudZone de pouvoir vendre leurs articles. Cela permettra d'améliorer leurs ventes car ceux-ci ne les font qu'après un concert ou alors parfois grâce aux réseaux sociaux.



**Outils utilisés**



* Laravel

  * Jetstream
  * Spatie
  * DebugBar
  * Telescope
  * Lang
* Livewire
* Tailwind CSS
* MongoDB
* MariaDB



**Défi techniques**



* Réalisation de Trait pour des filtres, CRUD et affichages afin d'éviter la répétition de code
* Utilisation de base de données en NOSQL à l'aide de mongoDB pour les tables avec un potentiel de contenu excessif informations
* Gérer toutes les erreurs d'affichage côté front-end
* Utilisation de query string afin d'apporter plus de précisions dans les tables
* Utilisation d'accesseurs pour des données qui doivent être modifiée à la vue de l'utilisateur



**Commandes et installation**



1. Installer dépendances PHP : composer install
2. Installer dépendances front-end : npm run build
3. Configurer l'environnement : Dupliquer le fichier .env.example en .env et y configurer les accès à la base de données
4. Générer la clé de l'application : php artisan key:generate
5. Lancer les migrations : php artisan migrate, avec seeder : php artisan migrate:fresh --seed
6. Démarrer le serveur php: php artisan serv
7. Démarrer le serveur front-end : npm run dev







