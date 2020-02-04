// Paths must be relative to the package.json root
module.exports = {
  src: [
    './web/wp-content/themes/<%= slug %>/src/scripts/**/[!_]*.js',
    './web/wp-content/themes/<%= slug %>/src/styles/**/[!_]*.scss',
  ],
  dist: './web/wp-content/themes/<%= slug %>/dist/',
  public: '/wp-content/themes/<%= slug %>/dist/',
};
