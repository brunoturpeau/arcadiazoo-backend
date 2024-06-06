# Animaux

## En tant qu'employé(e) ou vétérinaire je souhaite ___

[/] voir la liste des animaux
    [X] label: nom (link) (asc)
    [X] label: race (link)
    [X] label: état de santé (50 max)
    [-] label: habitat (link)
    [X] link: voir la fiche de l'animal
    [-] link: créer un rapport pour l'animal
    [-] lien: voir les rapports de l'animal
    [-] action: créer un rapport pour l'animal
    [-] filter: trier par ordre croissant ou décroissant
    [-] filter : filtrer par race et par habitat
    [-] filter : sélectionner un animal à l'aide d'une liste déroulante

[X] voir un animal
    [X] label: n°
    [X] label: nom 
    [X] label: race (link)
    [X] label: description (50 max)
    [X] label: état de santé (50 max)
    [-] label: habitat (link)
    [-] link: créer un rapport pour l'animal [veto]
    [-] link: créer un repas pour l'animal [employe]
    [X] sublist: rapport
        [X] label: n°
        [-] label: date (desc)
        [-] label: rapport (50 max)
        [X] link: voir le rapport
        [X] link: modifier le rapport [veto]
--- 
    [-] sublist: images

    [-] sublist: repas




    [X] voir la liste des rapports sur la fiche animal
    [X] voir les images sous forme de slideshow sur la fiche animal

## En tant qu'administrateur je souhaite ___


[/] voir la liste des animaux
    [X] idem employé(e)s
    [-] btn: créer un animal
    [-] link: modifier la fiche de l'animal
    [-] link: supprimer la fiche de l'animal




    [-] ajouter une ou plusieurs images
    [-] modifier une images
    [-] suprimer une images
    [-] qu'une image par défaut soit associée lors de la création d'un animal

## -----

* une miniature  animal.images[0].name
- le nom de l'animal
- la race liée à sa fiche
- l'état de santé
* l'habitat lié à sa fiche

- la ou les photo(s)
- les repas donnés par l'employé(e)
- l'alimentation préconisée par le vétérinaire
- les rapports

- un btn-icon Voir
- un btn-icon Rapport
- un bouton Créer un compte-rendu

 ## Notes

- Créer la route admin/rapport/{id}/ajout 
  