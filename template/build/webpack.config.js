const path = require('path');
const { mergeConfig } = require('@studiometa/webpack-config');
const config = require('./config');

const webpackConfig = mergeConfig({
  entry: config.js.entries,
  output: {
    path: config.js.dist,
    publicPath: config.js.publicPath,
  },
  resolve: {
    alias: config.alias,
  },
});

// Temp fix to remove the buggy VueLoaderPlugin
const [CleanTerminalPlugin, VueLoaderPlugin, ...OtherPlugins] = webpackConfig.plugins;
webpackConfig.plugins = [CleanTerminalPlugin, ...OtherPlugins];

module.exports = webpackConfig;
