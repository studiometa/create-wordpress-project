const config = require('./build/config');

module.exports = {
  root: true,
  extends: '@studiometa/eslint-config/prettier-es6',
  globals: {
    window: false,
    document: false,
  },
  parser: 'babel-eslint',
  parserOptions: {
    ecmaVersion: 2017,
    sourceType: 'module',
  },
  env: {
    es6: true,
  },
  settings: {
    'import/resolver': {
      node: {
        extensions: ['.js', '.mjs', '.vue'],
      },
      alias: {
        map: Object.entries(config.alias),
        extensions: ['.js', '.mjs', '.json', '.vue', '.svg'],
      },
    },
  },
};
