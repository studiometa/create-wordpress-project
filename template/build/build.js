process.env.NODE_ENV = 'production';

const rimraf = require('rimraf');
const Bundler = require('parcel-bundler');
const config = require('./studiometa.config');

rimraf.sync(config.dist);

const bundler = new Bundler(config.src, {
  outDir: config.dist,
  publicUrl: config.public,
  scopeHoist: true,
});

(async () => {
  try {
    await bundler.bundle();
  } catch (e) {
    // empty catch
  }

  process.exit();
})();
