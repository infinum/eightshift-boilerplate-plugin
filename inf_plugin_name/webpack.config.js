/* global process __dirname */

const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');
const webpack = require('webpack');

const CleanWebpackPlugin = require('clean-webpack-plugin');
const ExtractTextPlugin = require('extract-text-webpack-plugin');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');

const appPath = `${path.resolve(__dirname)}`;

// Dev Server
const proxyUrl = 'dev.plugin-boilerplate.com'; // local dev url example: dev.wordpress.com

// Plugin
const pluginPath = '/skin';
const pluginFullPath = `${appPath}${pluginPath}`;
const pluginPublicPath = `${pluginPath}/public/`;
const pluginAdminEntry = `${pluginFullPath}/assets/admin/application.js`;
const pluginAdminOutput = `${pluginFullPath}/public/admin`;
const pluginThemeEntry = `${pluginFullPath}/assets/theme/application.js`;
const pluginThemeOutput = `${pluginFullPath}/public/theme`;


// Outputs
const outputJs = 'scripts/[name].js';
const outputCss = 'styles/[name].css';
const outputFile = '[name].[ext]';
const outputImages = `images/${outputFile}`;
const outputFonts = `fonts/${outputFile}`;

const allModules = {
  rules: [
    {
      test: /\.(js|jsx)$/,
      use: 'babel-loader',
      exclude: /node_modules/,
    },
    {
      test: /\.json$/,
      exclude: /node_modules/,
      use: 'file-loader',
    },
    {
      test: /\.(png|svg|jpg|jpeg|gif|ico)$/,
      exclude: [/fonts/, /node_modules/],
      use: `file-loader?name=${outputImages}`,
    },
    {
      test: /\.(eot|otf|ttf|woff|woff2|svg)$/,
      exclude: [/images/, /node_modules/],
      use: `file-loader?name=${outputFonts}`,
    },
    {
      test: /\.scss$/,
      exclude: /node_modules/,
      use: ExtractTextPlugin.extract({
        fallback: 'style-loader',
        use: ['css-loader', 'postcss-loader', 'sass-loader'],
      }),
    },
  ],
};

const allPlugins = [
  new ExtractTextPlugin(outputCss),

  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
  }),

  // Use BrowserSync For assets
  new BrowserSyncPlugin({
    host: 'localhost',
    port: 3000,
    proxy: proxyUrl,
    files: [
      {
        match: ['**/*.php'],
      },
    ],
  }),

  new webpack.DefinePlugin({
    'process.env': {
      NODE_ENV: JSON.stringify(process.env.NODE_ENV || 'development'),
    },
  }),
];

// Use only for production build
if (!DEV) {
  allPlugins.push(
    new CleanWebpackPlugin([pluginAdminOutput, pluginThemeOutput]),
    new webpack.optimize.UglifyJsPlugin({
      output: {
        comments: false,
      },
      compress: {
        warnings: false,
        drop_console: true, // eslint-disable-line camelcase
      },
      sourceMap: true,
    })
  );
}

module.exports = [

  // Admin Part.
  {
    context: path.join(__dirname),
    entry: {
      application: [pluginAdminEntry],
    },
    output: {
      path: pluginAdminOutput,
      publicPath: pluginPublicPath,
      filename: outputJs,
    },

    module: allModules,

    plugins: allPlugins,

    devtool: DEV ? '#inline-source-map' : '',
  },

  // Theme Part.
  {
    context: path.join(__dirname),
    entry: {
      application: [pluginThemeEntry],
    },
    output: {
      path: pluginThemeOutput,
      publicPath: pluginPublicPath,
      filename: outputJs,
    },

    module: allModules,

    plugins: allPlugins,

    devtool: DEV ? '#inline-source-map' : '',
  },
];
