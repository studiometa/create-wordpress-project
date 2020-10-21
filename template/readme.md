# <%= url %>

> <%= description %>

## Installation

Cloner le dépôt :

```bash
git clone <%= repository %>
```

Créer et configurer le fichier `.env` en vous basant sur le fichier `.env.example`.

Installer les dépendances nécessaires :

```bash
# Installer les dépendances Composer avec PHP 7.3
php7.0 $(which composer) install

# Installer les dépendances NPM avec Node 12
nvm use 12
npm install
```

## Développement

### Commandes disponibles

#### NPM

| Commande | Description |
|-|-|
| `npm run dev` | Démarre le serveur de compilation des fichiers SCSS et JS du thème. |
| `npm run build` | Build les fichiers SCSS, JS et Vue du thème. |
| `npm run lint` | Lint les fichiers SCSS, JS, Vue et Twig du thème avec ESLint, Stylelint et Prettier. |
| `npm run lint:scipts` | Lint les fichiers JS et Vue du thème avec ESLint et Prettier. |
| `npm run lint:styles` | Lint les fichiers SCSS et Vue du thème avec Stylelint et Prettier. |
| `npm run lint:templates` | Lint les fichiers Twig avec Prettier. |
| `npm run fix` | Formate les fichiers SCSS, JS, Vue et Twig du thème avec ESLint, Stylelint et Prettier. |
| `npm run fix:scipts` | Formate les fichiers JS et Vue du thème avec ESLint et Prettier. |
| `npm run fix:styles` | Formate les fichiers SCSS et Vue du thème avec Stylelint et Prettier. |
| `npm run fix:templates` | Formate les fichiers Twig du thème Prettier. |


#### Composer

| Commande | Description |
|-|-|
| `composer phpcs` | Lint les fichiers PHP du thème et des plugins customs |
| `composer phpstan` | Analyse de manière statiques les fichiers PHP du thème et des plugins customs |

### Ajouter des plugins et mu-plugins

Pour ajouter des plugins et mu-plugins tiers, utilisez Composer avec l'aide de [wpackagist.org](https://wpackagist.org/). Par exemple, pour ajouter le plugin [Classic Editor](), vous pouvez procéder comme suit :

```bash
composer require wpackagist/classic-editor
```

Par défaut, tout ce qui se trouve dans les sous-dossiers de `web/wp-content` est ignoré par Git pour éviter de suivre les packages tiers installés avec Composer. Pour ajouter vos plugins et thèmes personnalisés à votre dépôt Git, vous devez ajouter des règles dans le fichier `.gitignore` :

```
!/web/wp-content/mu-plugins/my-mu-plugin.php
!/web/wp-content/plugins/my-plugin/
```
