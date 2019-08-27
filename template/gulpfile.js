const gulpConfig = require('@studiometa/gulp-config');
const config = require('./build/config');

module.exports = gulpConfig.create({
  styles: {
    src: config.scss.src,
    glob: config.scss.glob,
    dist: config.scss.dist,
  },
  scripts: {
    src: config.js.src,
    glob: config.js.glob,
    dist: config.js.dist,
    webpackOptions: require('./build/webpack.config'),
  },
  php: {
    src: config.theme,
    glob: ['**/*.php', '!vendor/**'],
    PHPCSOptions: {
      bin: './vendor/bin/phpcs',
      standard: './phpcs.xml',
    },
    PHPCBFOptions: {
      bin: './vendor/bin/phpcbf',
      standard: './phpcs.xml',
    },
  },
  server: {
    browserSyncOptions: config.browserSync,
    watchers: [
      {
        files: ['**/*.php', '**/*.twig'],
        options: {
          cwd: config.theme,
        },
        callbacks: [
          {
            event: 'change',
            callback: server => server.reload(),
          },
        ],
      },
    ],
  },
});
