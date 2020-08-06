const postcssConfig = {
  plugins: [require('tailwindcss'), require('autoprefixer')],
};

if (process.env.NODE_ENV === 'production') {
  postcssConfig.plugins = [
    ...postcssConfig.plugins,
    require('@fullhuman/postcss-purgecss')({
      content: [
        './web/wp-content/themes/<%= slug %>/src/js/**/*.js',
        './web/wp-content/themes/<%= slug %>/src/js/**/*.vue',
        './web/wp-content/themes/<%= slug %>/**/*.twig',
      ],
    }),
    require('cssnano'),
  ];
}

module.exports = postcssConfig;
