# SIGProject

Ce projet consiste à évaluer l'état de l'internet en Tunisie en remplissant un formulaire et en visualisant les réponses sur la carte géographique de la Tunisie.

# sigFront

La page d'acceuil et la page de la formulaire est développé en utilisant Angular 13.
Il faut exécuter ces commandes:
npm init
npm install -g @angular/cli
npm install bootstrap@3.3.7

# sigBack

Le back-end de ce projet est réalisé en utilisant SpringBoot (Architecture Maven).
Il faut changer "Application properties" pour pouvoir accéder à la base de données.

# sigMap

La partie de la visualisation de la map est faite ici en utilisant la library Leaflet (écrite en Javascript)
La communication avec la base de données est réalisé en utilisant des scripts php.
Pour pouvoir exploiter cette partie, vous devez avoir un serveur (WAMP est recommendé). 
Il faut supprimer ";" dans ces lignes qui existent dans php.ini:
;extension=pdo_pgsql
