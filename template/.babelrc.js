module.exports = {
	presets: ['@babel/preset-env'],
	plugins: [
		[
			'@babel/plugin-transform-runtime',
			{
				corejs: false,
				regenerator: false,
				useESModules: true,
			},
		],
		'@babel/plugin-syntax-dynamic-import',
	],
};
