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
         
    
---

## En tant que vétérinaire je souhaite ___

[/] voir la liste des habitats
    [X] idem employé(e)
    [-] link: ajouter ou modifier commentaire sur l'habitat

[-] action: créer un rapport

## En tant qu'administrateur je souhaite ___

[/] voir la liste des habitats
    [X] idem employé(e)
    [-] créer un habitat
    [-] modifier un habitat
    [-] supprimer un habitat

[X] voir un habitat
    [X] idem vétérinaire
    [-] link: créer un habitat
    [-] link: modifier l'habitat
    [-] action: supprimer l'habitat si aucun animal n'est associé (flash)