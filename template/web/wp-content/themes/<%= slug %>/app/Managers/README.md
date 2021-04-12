# Managers

@todo small section about what is a manager

## ThemeManager
The main manager, that will init all the other Managers
Bootstraps Theme related functions:
- Add data to global twig context
- Add twig extensions
- Add menus
- Add theme support
- ...

## AssetsManager
Bootstraps Studiometa\WP\Assets to handle enqueing styles and scripts

## TwigManager
Add Extentions and Functions to Twig

## WordPressManager
Add functionnality to WordPress

## CustomPostTypesManager
Register custom post types

## TransientsManager
Bootstraps Transients related functions
- Run transients cleaner tool if a configuration is specified in `config/transients_cleaner.yml` (see [configuration documentation](https://github.com/studiometa/wp-toolkit/tree/master#transient-cleaner)).

## TaxonomiesManager
Register custom taxonomies

<%_ if (acf) { _%>
## ACFManager
Bootsrap ACF related features
- Register ACF field groups
- Register ACF Options pages
- ...
<%_ } _%>

## Add a new manager
- Add it to the managers array in `functions.php`
@todo small section about when to create a new manager
