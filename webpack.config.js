/* global process __dirname */
const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');
const webpack = require('webpack');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');
const ManifestPlugin = require('webpack-manifest-plugin');

const appPath = `${path.resolve(__dirname)}`;

// Plugin
const pluginPath = '/assets';
const pluginFullPath = `${appPath}${pluginPath}`;
const pluginPublicPath = `${pluginPath}/public/`;
const pluginAdminOutput = `${pluginFullPath}/public`;

// Separate functionality
const pluginAdminEntry = `${pluginFullPath}/dev/application.js`;

// Outputs
const outputJs = 'scripts/[name]-[hash].js';
const outputCss = 'styles/[name]-[hash].css';
const outputFile = '[name].[ext]';
const outputImages = `images/${outputFile}`;

const outputStatic = '[name].[ext]';

const allModules = {
  rules: [
    {
      test: /\.(js|jsx)$/,
      exclude: /node_modules/,
      use: 'babel-loader',
    },
    {
      test: /\.json$/,
      exclude: /node_modules/,
      use: `file-loader?name=${outputStatic}`,
    },
    {
      test: /\.(png|svg|jpg|jpeg|gif|ico)$/,
      exclude: [/fonts/, /node_modules/],
      use: `file-loader?name=${outputStatic}`,
    },
    {
      test: /\.(eot|otf|ttf|woff|woff2|svg)$/,
      exclude: [/images/, /node_modules/],
      use: `file-loader?name=${outputStatic}`,
    },
    {
      test: /\.scss$/,
      exclude: /node_modules/,
      use: [
        MiniCssExtractPlugin.loader,
        'css-loader', 'postcss-loader', 'sass-loader',
      ],
    },
  ],
};

const allPlugins = [
  new MiniCssExtractPlugin({
    filename: outputCss,
  }),

  new webpack.ProvidePlugin({
    $: 'jquery',
    jQuery: 'jquery',
  }),

  new webpack.DefinePlugin({
    'process.env': {
      NODE_ENV: JSON.stringify(process.env.NODE_ENV || 'development'),
    },
  }),

  new ManifestPlugin(),
];

const allOptimizations = {
  runtimeChunk: false,
  splitChunks: {
    cacheGroups: {
      commons: {
        test: /[\\/]node_modules[\\/]/,
        name: 'vendors',
        chunks: 'all',
      },
    },
  },
};

allOptimizations.minimizer = [
  new UglifyJsPlugin({
    cache: true,
    parallel: true,
    sourceMap: true,
    uglifyOptions: {
      output: {
        comments: false,
      },
      compress: {
        warnings: false,
        drop_console: true, // eslint-disable-line camelcase
      },
    },
  }),
];

allPlugins.push(new CleanWebpackPlugin([pluginAdminOutput]));

module.exports = [

  // Skin
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

    externals: {
      jquery: 'jQuery',
    },

    optimization: allOptimizations,

    module: allModules,

    plugins: allPlugins,
  },
];
