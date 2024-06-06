# Animaux

## En tant qu'employé(e) ou vétérinaire je souhaite ___

[/] voir la liste des animaux
    [X] label: nom (link) (asc)
    [X] label: race (link)
    [X] label: état de santé (50 max)
    [_] label: habitat (link)
    [X] link: voir la fiche de l'animal
    [_] link: créer un rapport pour l'animal
    [_] lien: voir les rapports de l'animal
    [_] action: créer un rapport pour l'animal
    [_] filter: trier par ordre croissant ou décroissant
    [_] filter : filtrer par race et par habitat
    [_] filter : sélectionner un animal à l'aide d'une liste déroulante

[X] voir un animal
    [X] label: n°
    [X] label: nom 
    [X] label: race (link)
    [X] label: description (50 max)
    [X] label: état de santé (50 max)
    [_] label: habitat (link)
    [_] link: créer un rapport pour l'animal [veto]
    [_] link: créer un repas pour l'animal [employe]
    [X] sublist: rapport
        [X] label: n°
        [-] label: date (desc)
        [X] label: rapport (50 max)
        [X] link: voir le rapport
        [X] link: modifier le rapport [veto]
    [X] sublist: images
        [X] label: thumbnail
        [X] label: title
    [_] sublist: repas

--- 

## En tant qu'administrateur je souhaite ___

[X] voir la liste des animaux
    [X] idem employé(e)s
    [-] btn: créer un animal
    [-] link: modifier la fiche de l'animal
    [-] link: supprimer la fiche de l'animal


[X] voir un animal
    [-] sublist: images
    [_] link: modifier l'image
    [_] action: supprimer l'image (flash)

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
  