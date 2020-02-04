module.exports = {
  extends: '@studiometa/stylelint-config/prettier',
  rules: {
    'scss/at-rule-no-unknown': [
      true,
      {
        ignoreAtRules: ['extends', 'apply', 'tailwind', 'components', 'utilities', 'screen'],
      },
    ],
  },
};
