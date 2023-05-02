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
php vendor/bin/php-cs-fixer fix --dry-run --diff
```

Application des corrections possibles
```apacheconf
php vendor/bin/php-cs-fixer fix
```