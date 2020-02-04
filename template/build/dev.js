process.env.NODE_ENV = 'development';

const path = require('path');
const rimraf = require('rimraf');
const Bundler = require('parcel-bundler');
const server = require('browser-sync').create();

require('dotenv').config();

const config = require('./studiometa.config');

// Delete dist folder
rimraf.sync(config.dist);

// Create the dev parcel bundler
const bundler = new Bundler(config.src, {
  cacheDir: 'node_modules/.cache',
  outDir: config.dist,
  publicUrl: config.public,
  minify: false,
  watch: true,
  hmr: false,
});

// Configure browserSync
const browserSyncOptions = {
  open: false,
  proxy: process.env.APP_HOST,
  middleware: [bundler.middleware()],
};

// Enable `https://` with browserSync
if (
  process.env.APP_SSL &&
  process.env.APP_SSL === 'true' &&
  process.env.APP_SSL_CERT &&
  process.env.APP_SSL_KEY
) {
  browserSyncOptions.proxy = `https://${process.env.APP_HOST}`;
  browserSyncOptions.https = {
    cert: path.resolve(process.env.APP_SSL_CERT),
    key: path.resolve(process.env.APP_SSL_KEY),
  };
}

// Init the browserSync server
server.init(browserSyncOptions);

// And watch for changes
server.watch(path.join(config.dist, 'styles/**/*.css')).on('change', server.reload);
server.watch(path.join(config.dist, 'scripts/**/*.js')).on('change', server.reload);
server.watch(path.join(config.dist, '../templates/**/*.twig')).on('change', server.reload);
