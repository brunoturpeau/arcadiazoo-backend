#### En tant qu'utilisateur du back-office je souhaite ___

    [X] être redirigé automatiquement vers la page de login si je ne suis pas connecté
    [X] accéder à un dashbord personnalisé en fonction de mon role en me connectant avec un identifiant et un mot de passe
    [X] pouvoir de me déconnecter
    [X] pouvoir réinitialiser mon mot de passe de façon sécurisé
    [X] que l'application garde mes identifiants en mémoire pour une connexion ultérieure
    [X] voir s'afficher un message de confirmation lorsqu'une opération s'est bien déroulée (ajout et modification)

    [-] Pagination
    [-] Editor

#### En tant que vétérinaire je souhaite ___

> _Les RAPPORTS_

    [X] voir la liste des RAPPORTS avec, pour chaque item :
        - le numéro du rapport
        - le nom de l'animal
        - la date de passage
        - l'état de santé de l'animal
        - un btn-icon Voir, un btn-icon Modifier, un btn-icon Supprimer
        - un bouton Créer un rapport
    [-] voir chaque RAPPORT et y trouver :
        - le numéro du rapport
        - le nom de l'animal
        - la date de passage
        - l'état de santé de l'animal
        - l'alimentation préconisé et son grammage
    [-] pouvoir créer un RAPPORT à l'aide d'un formulaire [flash] 
        - la date de passage
        - le détail du rapport
        - l'état de santé de l’animal
        - le type de nourriture et la quantité préconisée
    [-] pouvoir modifier chaque RAPPORT [flash] 
    [-] pouvoir supprimer un RAPPORT [flash] 
    [-] voir la liste des RAPPORTS regroupés par animaux
    [-] voir la liste des RAPPORTS par ordre chronologique inversée
    [-] pouvoir trier par ordre croissant ou décroissant
    [-] pouvoir filtrer par animal et par habitat
    [-] que lors de la création d'un RAPPORT la date de passage contienne automatiquement la date du jour si je ne la renseigne pas

> _Les ANIMAUX_

    [-] voir la liste des animaux avec, pour chaque item :
        * une miniature  animal.images[0].name 
        - le nom de l'animal
        - la race
        - un btn-icon Voir
        * un btn-icon Rapport
    [-] voir la fiche d'un animal avec :
        - identifiant, nom, race, habitat
        - état de santé
        - photo(s)
        - les repas donnés par l'employé(e)
        - l'alimentation préconisée par le vétérinaire
        - les rapports
        - un bouton Créer un compte-rendu
    [-] pouvoir créer un rapport depuis le liste des animaux (animal sélectionné)
    [-] pouvoir sélectionner un animal à l'aide d'une liste déroulante
    [-] pouvoir trier par ordre croissant ou décroissant
    [-] pouvoir filtrer par race et par habitat

> _Les HABITATS_

    [X] avoir les mêmes fonctionnalités que les employé(e)s
    [-] pouvoir ajouter ou modifier un commentaire

#### En tant qu'employé(e) je souhaite ___

> _Les COMMENTAIRES_

    [-] voir la liste des COMMENTAIRES avec, pour chaque item :
        - la date de création
        - le pseudo
        * le commentaire tronqué
        * le statut
        * un btn-icon Voir
        * un btn-icon Modifier
        * un btn-icon Supprimer
    [X] pouvoir supprimer un commentaire [flash]

> _Les SERVICES_

    [X] voir la liste des SERVICES et y trouver, pour chaque item :
        - le numéro du service
        - le nom du service
        - un btn-icon Voir, un btn-icon Modifier

> _Les REPAS_

    [&] voir la liste des REPAS et y trouver, pour chaque item :
        - le numéro du repas
        - la date 
        - l'heure
        - le nom de l'animal
        - un btn-icon Voir, un btn-icon Modifier, un btn-icon Supprimer
        - un bouton Créer un repas

> _Les HABITATS_

    [X] voir la liste des HABITATS avec, pour chaque item :
        - le nom de l'habitat
        - un commentaire
        - un btn-icon Voir

> _Les ANIMAUX_

    [X] avoir les mêmes fonctionnalités que les vétérinaires

#### En tant qu'administrateur je souhaite ___

> _Les RAPPORTS_

    [X] avoir les mêmes fonctionnalités que les vétérinaires

> _Les COMMENTAIRES_

    [X] avoir les mêmes fonctionnalités que les employé(e)s

> _Les REPAS_

    [X] avoir les mêmes fonctionnalités que les employé(e)s

> _Les ANIMAUX_

    [X] avoir les mêmes fonctionnalités que les employé(e)s
    [-] pouvoir créer un animal
    [-] pouvoir modifier un animal
    [-] pouvoir supprimer un animal
    [-] pouvoir ajouter une ou plusieurs images
    [-] pouvoir modifier une images
    [-] pouvoir suprimer une images
    [-] qu'une image par défaut soit associée lors de la création d'un animal

> _Les HABITATS_

    [X] avoir les mêmes fonctionnalités que les employé(e)s
    [&] pouvoir créer un habitat [flash]
    [-] pouvoir supprimer un habitat

> _Les SERVICES_

    [X] avoir les mêmes fonctionnalités que les employé(e)s
    [-] pouvoir créer un service 
    [-] pouvoir supprimer un service 

> _Les RACES_

    [-] voir la liste des RACES avec, pour chaque item :
        - le nom 
        * une description tronquée
        - un btn-icon Voir
        - un btn-icon Modifier
        - un btn-icon Supprimer
        * la liste des animaux qui compose la race, pour chaque item :
            * le nom de l'animal
            * un btn-icon Voir
            * un btn-icon Repas
    [-] pouvoir créer un repas depuis le liste des Repas (animal sélectionné)
    [-] pouvoir créer une race 
    [-] pouvoir modifier une race 
    [&] pouvoir supprimer une race il elle ne contient pas d'animaux associé [flash]

> _Les COMPTES_

    [X] voir la liste des COMPTES avec, pour chaque item :
        - le prénom, le nom
        - l'adresse e-mail
        - le statut et le rôle
        - un btn-icon Voir, un btn-icon Modifier
        - un bouton Créer un(e) Employé(e) et un bouton Créer un vétérinaire
    [-] voir un COMPTE sélectionné avec, pour chaque item :
        - le n° d'utilisateur
        - le prénom, le nom
        - l'adresse e-mail
        - le statut et le rôle

> _Les IMAGES_

    [&] voir la liste des IMAGES avec, pour chaque item :
        - une miniature
        - le titre de l'image
        - le nom de l'animal correspondant
        - un lien vers la fiche de l'animal
        - un btn-icon Supprimer
    [&] pouvoir supprimer une image [flash]

> _La SOCIETE_

    [-] voir les informations sur la société
        * le nom de la société
        * l'adresse
        * les horaires
        * une description
    [-] modifier les informations sur la société
        * le nom de la société
        * l'adresse
        * les horaires
        * une description

---

[-] [largeur champ date](https://starswebcommunication.tinytake.com/msc/OTY4NzU2N18yMzMxOTA5NQ)
[-] refaction td.actions