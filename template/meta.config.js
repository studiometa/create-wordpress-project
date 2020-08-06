// Paths must be relative to the package.json root
module.exports = {
  src: [
    './web/wp-content/themes/<%= slug %>/src/js/*.js',
    './web/wp-content/themes/<%= slug %>/src/js/pages/*.js',
    './web/wp-content/themes/<%= slug %>/src/js/pages/*/index.js',
    './web/wp-content/themes/<%= slug %>/src/css/**/[!_]*.scss',
  ],
  dist: './web/wp-content/themes/<%= slug %>/dist/',
  public: '/wp-content/themes/<%= slug %>/dist/',
  watch: ['./web/wp-content/themes/<%= slug %>/templates/**/*.twig'],
};
