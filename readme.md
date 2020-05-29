# Create WordPress Project

[![NPM Version](https://img.shields.io/npm/v/@studiometa/create-wordpress-project/alpha.svg?style=flat-square)](https://www.npmjs.com/package/@studiometa/create-wordpress-project)
[![Dependency Status](https://img.shields.io/david/studiometa/create-wordpress-project.svg?label=deps&style=flat-square)](https://david-dm.org/studiometa/create-wordpress-project)
[![devDependency Status](https://img.shields.io/david/dev/studiometa/create-wordpress-project.svg?label=devDeps&style=flat-square)](https://david-dm.org/studiometa/create-wordpress-project?type=dev)

> A generator to kickstart your WordPress project in a few seconds! ⚡ 

## Usage

Run the following command to bootstrap a WordPress project using Studio Meta's tools and workflows:

```
npx @studiometa/create-wordpress-project@alpha project-name
```

## Documentation

This tool will generate a WordPress project managed by Composer and Webpack. See the [readme.md](./template#readme) file in the template folder for a more detailed documentation.

## Contributing

This project's branches are managed with [Git Flow](https://github.com/petervanderdoes/gitflow-avh), every feature branch must be merged into develop via a pull request.

## TODO

- [ ] Test if Wordpress loads plugins in a subfolder of `wp-content/plugins/`
- [ ] Test if Wordpress loads mu-plugins in a subfolder of `wp-content/mu-plugins/`
- [ ] Test if Wordpress loads themes in a subfolder of `wp-content/themes/`
- [ ] Use a child theme