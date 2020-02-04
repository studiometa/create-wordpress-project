const postcssConfig = {
  plugins: [require('tailwindcss'), require('autoprefixer')],
};

if (process.env.NODE_ENV === 'production') {
  postcssConfig.plugins.push(
    require('@fullhuman/postcss-purgecss')({
      content: [
        './web/wp-content/themes/fqdn/src/js/**/*.js',
        './web/wp-content/themes/fqdn/templates/**/*.twig',
      ],
    })
  );
}

module.exports = postcssConfig;
