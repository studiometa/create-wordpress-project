import { defineConfig } from '@studiometa/webpack-config';

// Paths must be relative to the package.json root
export default defineConfig({
  target: 'modern',
  presets: ['tailwindcss'],
  src: [
    './web/wp-content/themes/studiometa/src/js/*.js',
    './web/wp-content/themes/studiometa/src/js/pages/*.js',
    './web/wp-content/themes/studiometa/src/js/pages/*/index.js',
    './web/wp-content/themes/studiometa/src/css/**/[!_]*.scss',
  ],
  dist: './web/wp-content/themes/studiometa/dist/',
  public: '/wp-content/themes/studiometa/dist/',
  watch: ['./web/wp-content/themes/studiometa/templates/**/*.twig'],
});
