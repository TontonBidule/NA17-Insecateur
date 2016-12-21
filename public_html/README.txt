achatShop.php
>recoit les informations du formulaire de AffichageAlentours
>envoi de la requete à la BDD, message avec le solde restant

affichageAlentours.php
>permet d'afficher les trois tables Pokemons,Pokestops et Shops des alentours
>permet de selectionner ce qu'on veut faire dans chaque table

ajouterJoueur.php

capturePokemon.php
>lié au formulaire de AffichageAlentours
>permet de tenter la capture du pokemon
>enregistre le pokemon capturé dans la BDD

connexion.php
>automatise le pgconnect, la connexion à la BDD
>inclut l'enregistrement de la position GPS

controlerTriche.php
>compare les infos du joueur avec le règlement (nb de pokestops visités,nb de pokemons capturés)

deconnexion.php
>deconnecte de la base de donnée
>ferme la session

enregistrementGPS.php
>inclut dans connexion.php
>permet d'enregistrer la position a chaque connexion
>envoie un formulaire

enregistrerGPS.php
>recoit les infos de enregistrementGPS et les enregistre dans la BDD
>eventuellement à fusionner avec enregistrementGPS

environnementTest.sql
>permet de créer une série de INSERT pour tester la BDD avec des valeurs titi toto

identifiants.php
>stocke les identifiants de la BDD
>dans l'idéal il faudrait stocker les identifiants dans la BDD (sécurité)

implémentationSQL.sql
>code de création de la BDD

index.html
>page d'accueil du site

inscription.php

inscription2.php

pokemonEstProche.php
>est appelé par affichageAlentours
>à fusionner peut etre

pokestopEstProche.php
>est appelé par affichageAlentours
>à fusionner peut etre

rechargerCompte.php
>appelé via index.html

recupererObjets.php
>appelé via affichageAlentours.php
>permet de prendre les objets d'un pokestop