import {chalk} from 'chalk'; // eslint-disable-line import/no-extraneous-dependencies

export const log = (msg) => console.log(msg);
export const error = (msg) => log(`${chalk.bgRed('Error')}${chalk.red(' - ')}${msg}`);
export const variable = (msg) => chalk.green(msg);
export const label = (msg) => log(chalk.cyan(msg));

export const capCase = (string) => string.replace(/\W+/g, '_').split('_').map((item) => item[0].toUpperCase() + item.slice(1)).join('_');
