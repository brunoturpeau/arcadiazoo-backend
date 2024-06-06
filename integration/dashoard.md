# Dashboard

## En tant que vétérinaire, sur ma dashboard, je souhaite ___

[/] voir la liste des animaux
    [X] label: nom (link) (asc)
    [X] label: race (link)
    [-] label: habitat (link)
    [-] label: nombre d'animaux
    [X] lien: voir la fiche de l'animal
    [-] lien: créer un rapport pour l'animal
    [-] lien: voir les rapports de l'animal

[X] voir la liste des rapports
    [X] label: date (desc)
    [X] label: animal (link)
    [X] label: description (50 max)
    [X] lien: voir le rapport
    [X] lien: modifier le rapport

[/] voir la liste des habitats
    [X] label: nom
    [X] label: description (50 max)
    [-] label: nombre d'animaux
    [X] lien: voir l'habitat
    [-] lien: mettre un commentaire sur l'habitat

## En tant qu'employé(e), sur ma dashboard, je souhaite ___

[X] voir la liste des animaux
    [X] idem vétérinaires

[X] voir la liste des habitats
    [X] idem vétérinaires

[X] voir la liste des commentaires
    [X] label: date (desc)
    [X] label: pseudo
    [X] label: commentaire (50 max)
    [X] label: publié
    [X] link: voir le commentaire
    [X] link: modifier le commentaire
    [X] action: supprimer le commentaire (flash)

[X] voir la liste des services
    [X] label: nom
    [X] label: description (50 max)
    [X] link: voir le commentaire
    [X] link: modifier le commentaire

## En tant qu'administrateur, sur ma dashboard, je souhaite ___

[X] voir la liste des animaux
    [X] idem employé(e)s
    [X] lien: modifier un animal

[-] voir la liste des rapports
    [X] idem vétérinaires

[/] voir la liste des habitats
    [X] idem employé(e)s
    [-] link: créer un habitat
    [-] link: modifier un habitat
    [-] link: supprimer un habitat si il ne contient aucun animal

[X] voir la liste des commentaires
    [X] idem employé(e)s

[X] voir la liste des services
    [X] idem employé(e)s