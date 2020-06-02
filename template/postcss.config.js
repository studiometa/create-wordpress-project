const postcssConfig = {
  plugins: [
    require('tailwindcss'),
    require('postcss-custom-properties'),
    require('autoprefixer'),
  ],
};

if (process.env.NODE_ENV === 'production') {
  postcssConfig.plugins = [
    ...postcssConfig.plugins,
    require('cssnano'),
  ];
}

module.exports = postcssConfig;
