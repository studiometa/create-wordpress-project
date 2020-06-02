const merge = require('lodash.merge');
const plugin = require('tailwindcss/plugin');
const config = require('@studiometa/tailwind-config');

/**
 * TailwindCSS Configuration File
 *
 * @docs    https://tailwindcss.com/docs/configuration
 * @default https://github.com/studiometa/tailwind-config/blob/develop/src/index.js
 */
module.exports = merge(config, {
  // Extends the default Studio Meta Tailwind configuration here...
  plugins: [],
  theme: {},
  purge: {
    // Learn more on https://tailwindcss.com/docs/controlling-file-size/#removing-unused-css
    enabled: process.env.NODE_ENV === 'production',
    content: [
      './web/wp-content/themes/<%= slug %>/src/js/**/*.js',
      './web/wp-content/themes/<%= slug %>/src/js/**/*.vue',
      './web/wp-content/themes/<%= slug %>/**/*.twig',
    ],
  },
});
