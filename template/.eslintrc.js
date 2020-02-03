const config = require('./build/config');

module.exports = {
  root: true,
  extends: '@studiometa/eslint-config',
  globals: {
    window: false,
    document: false,
  },
  settings: {
    'import/resolver': {
      alias: {
        map: Object.entries(config.alias),
        extensions: ['.js', '.mjs', '.json', '.vue', '.svg'],
      },
    },
  },
};
