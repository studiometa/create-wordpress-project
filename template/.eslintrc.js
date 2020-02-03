const config = require('./build/config');

module.exports = {
  root: true,
  extends: '@studiometa/eslint-config',
  settings: {
    'import/resolver': {
      alias: {
        map: Object.entries(config.alias),
        extensions: ['.js', '.mjs', '.json', '.vue', '.svg'],
      },
    },
  },
};
