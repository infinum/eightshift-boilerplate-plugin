const chalk = require('chalk'); // eslint-disable-line import/no-extraneous-dependencies

const log = (msg) => console.log(msg);

module.exports.log = log;
module.exports.error = (msg) => log(`${chalk.bgRed('Error')}${chalk.red(' - ')}${msg}`);
module.exports.variable = (msg) => chalk.green(msg);
module.exports.label = (msg) => log(chalk.cyan(msg));

module.exports.capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');
