require('dotenv').config();
const path = require('path');
const { findEntries } = require('@studiometa/webpack-config');

const docroot = path.resolve(__dirname, '../web');
const plugins = path.resolve(docroot, 'wp-content/plugins');
const muPlugins = path.resolve(docroot, 'wp-content/mu-plugins');
const theme = path.resolve(docroot, 'wp-content/themes/<%= themeSlug %>');
const src = path.resolve(theme, 'src');
const dist = path.resolve(theme, 'static');

// Public paths
const themePublic = `/${path.relative(
  docroot,
  path.resolve(docroot, 'wp-content/themes/<%= themeSlug %>')
)}`;

module.exports = {
  src,
  docroot,
  plugins,
  muPlugins,
  theme,
  themePublic,
  js: {
    src: path.resolve(src, 'js'),
    glob: '**/*.js',
    dist: path.resolve(dist, 'js'),
    publicPath: path.join(themePublic, 'static/js'),
    get entries() {
      return findEntries([this.glob, '!**/_*.js'], this.src);
    },
  },
  scss: {
    src: path.resolve(src, 'scss'),
    glob: '**/*.scss',
    dist: path.resolve(dist, 'css'),
    publicPath: path.join(themePublic, 'static/css'),
    get entries() {
      return findEntries(this.glob, this.src);
    },
  },
  php: {
    src: docroot,
    glob: [
      path.join(plugins, '<%= projectSlug %>-*/**/*.php'),
      path.join(plugins, 'studiometa-*/**/*.php'),
      path.join(muPlugins, '<%= projectSlug %>-*.php'),
      path.join(muPlugins, '<%= projectSlug %>-*/**/*.php'),
      path.join(muPlugins, 'studiometa-*.php'),
      path.join(muPlugins, 'studiometa-*/**/*.php'),
      path.join(theme, '**/*.php'),
      '!vendor/**',
    ],
  },
  get browserSync() {
    const options = {
      host: process.env.APP_HOST,
    };

    if (
      process.env.APP_SSL &&
      process.env.APP_SSL === 'true' &&
      process.env.APP_SSL_CERT &&
      process.env.APP_SSL_KEY
    ) {
      options.https = {
        cert: path.resolve(process.env.APP_SSL_CERT),
        key: path.resolve(process.env.APP_SSL_KEY),
      };
    }

    return options;
  },
};
