const {exec} = require('promisify-child-process'); // eslint-disable-line import/no-extraneous-dependencies
const consoleJs = require('./setup/console.js');
const filesJs = require('./setup/files.js');

const {
  installStep,
  installStepFinal,
  outputIntro,
  promptData,
} = consoleJs;

const {replaceThemeData} = filesJs;

const run = async() => {

  // Write a pretty intro for our install script.
  outputIntro();

  // Prompt the user for all info needed for installation.
  const data = await promptData([
    {
      key: 'name',
      icon: 'earth_africa',
      title: 'Please enter your plugin\'s name',
      promptLabel: 'Name',
      error: 'Plugin\'s name cannot be empty',
    },
  ]);

  await installStep({
    title: '1. Renaming plugin',
    thisHappens: replaceThemeData(data),
  });

  await installStep({
    title: '2. Installing Composer dependencies',
    thisHappens: exec('composer install'),
  });

  await installStep({
    title: '3. Updating autoloader',
    thisHappens: exec('composer -o dump-autoload'),
  });

  await installStep({
    title: '4. Building assets',
    thisHappens: exec('npm run build'),
  });

  installStepFinal();
};
run();
