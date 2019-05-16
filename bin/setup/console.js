const ora = require('ora'); // eslint-disable-line import/no-extraneous-dependencies
const emoji = require('node-emoji'); // eslint-disable-line import/no-extraneous-dependencies
const chalk = require('chalk'); // eslint-disable-line import/no-extraneous-dependencies
const prompt = require('prompt-sync')(); // eslint-disable-line import/no-extraneous-dependencies
const misc = require('./misc.js');

const {
  log,
  error,
  variable,
  label,
  capCase,
} = misc;


/**
 * Prompts a user for something
 *
 * @param {object} settings
 */
const promptFor = ({
  icon = '',
  title,
  promptLabel,
  minLength = 0,
}) => {
  let userInput = '';

  label(`${emoji.get(icon) || ''} ${title}`);
  do {
    userInput = prompt(`${promptLabel}: `);

    if (userInput.length <= minLength) {
      error(error);
    }
  } while (userInput.length <= minLength && userInput !== 'exit');
  label('');
  if (userInput === 'exit') {
    log('Exiting script...');
    process.exit();
  }

  return userInput;
};

/**
 * Performs an install step with the ora spinner.
 */
module.exports.installStep = async({title, thisHappens, isFatal = false}) => {
  const spinner = ora(title).start();

  await thisHappens.then(() => {
    spinner.succeed();
  }).catch((exception) => {
    spinner.fail();
    error(exception);

    if (isFatal) {
      process.exit();
    }
  });
};

/**
 * Outputs a success message after successfully setting up the plugin.
 */
module.exports.installStepFinal = async() => {
  log('');
  log(`${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')} Your plugin is now ready! ${emoji.get('tada')}${emoji.get('tada')}${emoji.get('tada')}`);
  log('');
  log(`Please run ${variable('npm start')} to start developing.`);
  log('');
  log(chalk.red('---------------------------------------------------------------'));
};

/**
 * Prompts the user for all things defined in whatToPromptFor.
 */
module.exports.promptData = async(whatToPromptFor) => {
  const data = {};
  whatToPromptFor.forEach(async(singlePrompt) => {
    data[singlePrompt.key] = promptFor(singlePrompt);
  });

  // Implicitly build other things we need from the name.
  if (data.name) {
    data.packageName = data.name.toLowerCase().split(' ').join('-');
    data.namespace = capCase(data.packageName);
  }

  return data;
};

/**
 * Outputs the boilerpalte intro.
 */
module.exports.outputIntro = async() => {
  log(chalk.red('---------------------------------------------------------------'));
  log(chalk.red(''));
  log(chalk.red('    _ _ _ ___ '));
  log(chalk.red('    | | | |__| '));
  log(chalk.red('    |_|_| |   '));
  log(chalk.red('    ___  ____ _ _    ____ ____ ___       ____ ___ ____ '));
  log(chalk.red('    |__| |  | | |    |___ |__/ |__| |    |__|  |  |___ '));
  log(chalk.red('    |__| |__| | |___ |___ |  \\ |    |___ |  |  |  |___ '));
  log(chalk.red('    ___  _    _  _ ____ _ _  _  '));
  log(chalk.red('    |__] |    |  | | __ | |\\ |  '));
  log(chalk.red('    |    |___ |__| |__] | | \\|  '));
  log(chalk.red(''));
  log(chalk.red(''));
  log('    Welcome to Boilerplate setup script for your plugin!');
  log(chalk.red(''));
  log('    This script will uniquely set up your plugin.');
  log(chalk.red(''));
  log(chalk.red(''));
};

