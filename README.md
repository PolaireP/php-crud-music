# Projet php musique

## Auteur : Poirrier Romain

## Installation / configuration

### Serveur Web Local

Pour lancer le serveur web local, il faut entrer la commande suivante en console :
```
php -d display_errors -S localhost:8000 -t public/
```

### Style de codage

Première vérification de possible correction
```apacheconf
php vendor/bin/php-cs-fixer fix --dry-run
```

Seconde vérification avec visualisation des corrections possible
```apacheconf
composer test:cs
```
ou
```apacheconf
php vendor/bin/php-cs-fixer fix --dry-run --diff
```

Application des corrections possibles
```apacheconf
composer fix:cs
```
ou
```apacheconf
php vendor/bin/php-cs-fixer fix
```

### Configuration de la base de donnée

Le fichier ``.mypdo.ini`` permet de faciliter la connexion à la base de donnée, notament en l'intégrant à la commande
``start:linux``.

### Tests

Afin de simplifier les tests du code, les scripts ``tests:cs`` et ``test:codecept`` ont été regroupé dans le script ``test``

```apacheconf
composer test
```