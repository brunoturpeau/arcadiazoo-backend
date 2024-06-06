# Habitat

## En tant qu'employé(e) je souhaite ___

[X] voir la liste des habitats
    [X] label: n°
    [X] label: nom
    [X] label: description (50 max)
    [X] label: commentaire (50 max)
    [_] label: nombre d'animaux
    [X] link: voir l'habitat

[X] voir un habitat
    [X] label: nom
    [X] label: description (50 max)
    [X] label: commentaire (50 max)
    [X] label: nombre d'animaux
    [X] sublist: animaux
        [X] label: n°
        [_] label: miniature
        [_] label: nom (link) (asc)
        [X] label: race (link)
        [X] link: voir l'animal

## En tant que vétérinaire je souhaite ___

[X] voir la liste des habitats
    [X] idem employé(e)
    [X] link: ajouter ou modifier commentaire sur l'habitat

[X] voir un habitat
    [X] idem employé(e)
    [X] link: ajouter ou modifier commentaire sur l'habitat
    [X] sublist: animaux
        [_] link: créer un rapport pour l'animal

## En tant qu'administrateur je souhaite ___

[X] voir la liste des habitats
    [X] idem employé(e)
    [X] link: créer un habitat
    [X] link: modifier un habitat
    [X] action: supprimer un habitat si il ne contient aucun animal (flash)

[X] voir un habitat
    [X] idem vétérinaire
    [X] link: modifier l'habitat
    [X] action: supprimer l'habitat si aucun animal n'est associé (flash)
        
[X] modifier un habitat (flash)
    [X] input: nom
    [X] input: description
    [X] input: commentaire
    [X] link: supprimer un habitat qui ne contient pas d'entrées associées (flash)

[X] créer un habitat (flash)
    [X] input: nom
    [X] input: description
    [X] input: commentaire
