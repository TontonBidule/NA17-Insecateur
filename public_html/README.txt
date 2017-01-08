index.php
>Ã  include sur chaque fichier aprÃ¨s la balise </head>
>affiche le menu et le le titre "Pokemon GO" en haut de la page

achatShop.php
>recoit les informations du formulaire de AffichageAlentours
>envoi de la requete à la BDD, message avec le solde restant

affichageAlentours.php
>permet d'afficher les trois tables Pokemons,Pokestops et Shops des alentours
>permet de selectionner ce qu'on veut faire dans chaque table

ajouterJoueur.php

capturePokemonResultat.php
>lié au formulaire de AffichageAlentours
>permet de tenter la capture du pokemon
>enregistre le pokemon capturé dans la BDD

connexionBDD.php
>automatise le pgconnect, la connexion à la BDD
>inclut l'enregistrement de la position GPS

controlerTriche.php
>compare les infos du joueur avec le règlement (nb de pokestops visités,nb de pokemons capturés)

deconnexionBDD.php
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

function.sql
>fonctions SQL de la BDD

index.php
>page d'accueil du site

accessJoueur.php
>Acc¨¨s des joueurs

inscription.php
>sert ¨¤ l'inscription des joueurs

inscription2.php
>sert ¨¤ l'inscription des joueurs

capturePokemonFormulaire.php
>est appelé par affichageAlentours
>à fusionner peut etre

visitePokestopFormulaire.php
>est appelé par affichageAlentours
>à fusionner peut etre

rechargerCompte.php
>appelé via index.php

visitePokestopResultat.php
>appelé via affichageAlentours.php
>permet de prendre les objets d'un pokestop

administration.php
>permet de créer des pokémons, des arènes, shops, de modifier les pokémons et de visualiser le profil de chaque utilisateur
>(sera sous divisé en différentes pages php, deviendra surement une page .html)
