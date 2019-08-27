module.exports = {
	extends: '@studiometa/eslint-config/prettier-es6',
	overrides: [
		{
			files: ['gulpfile.js', 'webpack.config.js'],
			rules: {
				'global-require': 'off',
				'import/no-extraneous-dependencies': 'off',
			},
		},
	]
};