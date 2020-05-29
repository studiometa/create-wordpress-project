# <%= slug %>

> <%= description %>

## Installation

```bash
git clone <%= repository %>
```

Create a `.env` file based on `.env.example` and run `$ composer install`

## Development

Let's get you started by intilizing the project with `$ npm install`
Once packages have been installed, start your dev environment with `$ npm run dev` 🚀

### Webpack

### SCSS

Styles are managed with postCSS and tailwind css.
The `.scss` files are stored in `/web/wp-content/themes/<%= slug %>/css`.

### JS

### Twig

### Add plugins, mu-plugins and themes

To add third party plugins, mu-plugins and themes, use Composer with the help of [wpackagist.org](https://wpackagist.org/). For example, to add the [Classic Editor]() plugin, you can do the following:

```bash
composer require wpackagist/classic-editor
```

By default, everything in the subfolders of `web/wp-content` are ignored by Git to avoid tracking thir party packages installed with Composer. To add your custom plugins and themes to your Git repository, you have to add rules in the `.gitignore` file:

```ruby
!/web/wp-content/mu-plugins/my-mu-plugin.php
!/web/wp-content/plugins/my-plugin/
```

## Releases

### Git Flow 

### Changelog

