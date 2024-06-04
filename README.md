# ARCADIA ZOO 

## Evaluation en Cours de Formation

Préparation au Titre Professionnel[integration.md](..%2Farcadiazoo_backend%2Fdoc%2Fintegration.md)
> RNCP37674 - Développeur web et web mobile

## Le projet

Cette application fournie une API Rest pour le site vitrine Arcadia Zoo.


## Installation du backend

Pour faire fonctionner l'application sur votre poste de travail, suivez la procédure :

1. Clonez l'application
```bash
git clone https://github.com/brunoturpeau/arcadiazoo-backend.git
```

2. Installez les dépendances

```bash
cd arcadiazoo_backend
composer install
npm install
```

3. Compilez les fichiers Tailwind

```bash
php bin/console tailwind:build -w
```

4. Créez un fichier .env.local

```bash
cp .env .env.local
```

5. Modifiez DATABASE_URL

```bash
DATABASE_URL="mysql://root@127.0.0.1:3306/sf_arcadia-backend?serverVersion=8"
```

6. Créez la base de données et ses tables

```bash
php bin/console d:d:c
symfony console doctrine:schema:update --force
```

7. Créez un jeu de données test

```bash
php bin/console doctrine:fixtures:load
```

8. Démarrez le serveur

```bash
symfony serve -d
```
Si le port est disponible, l'application devrait être visible sur :
[https://127.0.0.1:8000/](https://127.0.0.1:8000/)

---

### Identifiants de démo

| IDENTIFIANT           | MOT DE PASSE | ROLE        |
|-----------------------|--------------|-------------|
| <admin@test.fr>       | admin        | ADMIN       |
| <employe@test.fr>     | employe      | EMPLOYE     |
| <veterinaire@test.fr> | veterinaire  | VETERINAIRE |
