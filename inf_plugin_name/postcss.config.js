/* global process __dirname */
const DEV = process.env.NODE_ENV !== 'production';

const path = require('path');

const autoPrefixer = require('autoprefixer');
const cssMqpacker = require('css-mqpacker');
const cssNano = require('cssnano');

const plugins = [
  autoPrefixer,
  cssMqpacker,
];

// Use only for production build
if (!DEV) {
  plugins.push(cssNano);
}

module.exports = {plugins};
