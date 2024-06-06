# Habitat

## En tant qu'employé(e) je souhaite ___

[X] voir la liste des habitats
    [X] label: n°
    [X] label: nom
    [X] label: description (50 max)
    [X] label: commentaire (50 max)
    [-] label: nombre d'animaux
    [X] link: voir l'habitat

[X] voir un habitat
    [X] label: nom
    [X] label: description (50 max)
    [X] label: commentaire (50 max)
    [X] label: nombre d'animaux
    [X] sublist: animaux
        [X] label: n°
        [-] label: miniature
        [-] label: nom (link) (asc)
        [X] label: race (link)
        [X] link: voir l'animal

## En tant que vétérinaire je souhaite ___

[X] voir la liste des habitats
    [X] idem employé(e)
    [X] link: ajouter ou modifier commentaire sur l'habitat


## En tant qu'administrateur je souhaite ___

[X] voir la liste des habitats
    [X] idem employé(e)
    [X] link: créer un habitat
    [-] link: modifier un habitat
    [-] action: supprimer un habitat si il ne contient aucun animal

[X] voir un habitat
    [X] idem vétérinaire
    [-] link: créer un habitat
    [-] link: modifier l'habitat
    [-] action: supprimer l'habitat si aucun animal n'est associé (flash)

[X] créer un habitat