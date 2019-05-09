// import {exec} from 'promisify-child-process'; // eslint-disable-line import/no-extraneous-dependencies

import {
  installStep,
  installStepFinal,
  outputIntro,
  promptData,
} from './setup/console';
import {replaceThemeData} from './setup/files';

const exec = require('promisify-child-process');

const run = async() => {

  // Write a pretty intro for our install script.
  outputIntro();

  // Prompt the user for all info needed for installation.
  const data = promptData([
    {
      key: 'name',
      icon: 'earth_africa',
      title: 'Please enter your plugin\'s name',
      promptLabel: 'Name',
      error: 'Plugin\'s name cannot be empty',
    },
  ]);

  installStep({
    title: '1. Renaming plugin',
    thisHappens: replaceThemeData(data),
  });

  installStep({
    title: '2. Installing Composer dependencies',
    thisHappens: exec('composer install'),
  });

  installStep({
    title: '3. Updating autoloader',
    thisHappens: exec('composer -o dump-autoload'),
  });

  installStep({
    title: '4. Building assets',
    thisHappens: exec('npm run build'),
  });

  installStepFinal();
};
run();
