module.exports = {
  extends: '@studiometa/eslint-config',
  overrides: [
    {
      files: ['gulpfile.js', 'webpack.config.js'],
      rules: {
        'global-require': 'off',
        'import/no-extraneous-dependencies': 'off',
      },
    },
  ],
};
