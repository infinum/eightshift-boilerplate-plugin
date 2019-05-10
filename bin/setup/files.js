const replace = require('replace-in-file'); // eslint-disable-line import/no-extraneous-dependencies
const path = require('path');
const fs = require('fs');

const fullPath = path.join(process.cwd());

/**
 * Performs a wide search & replace.
 *
 * @param {string} findString
 * @param {string} replaceString
 */
const findReplace = async(findString, replaceString) => {
  const regex = new RegExp(findString, 'g');
  const options = {
    files: `${fullPath}/**/*`,
    from: regex,
    to: replaceString,
    ignore: [
      path.join(`${fullPath}/node_modules/**/*`),
      path.join(`${fullPath}/.git/**/*`),
      path.join(`${fullPath}/.github/**/*`),
      path.join(`${fullPath}/vendor/**/*`),
      path.join(`${fullPath}/packages/**/*`),
      path.join(`${fullPath}/bin/*.js`),
      path.join(`${fullPath}/bin/setup/*`),
    ],
  };

  if (findString !== replaceString) {
    await replace(options);
  }
};

module.exports.findReplace = findReplace;
module.exports.replaceThemeData = async({name, packageName, namespace}) => {

  // Plugin's main file - change name.
  await replace({
    files: path.join(fullPath, 'wp-boilerplate-plugin.php'),
    from: /^ \* Plugin Name: {7}.*$/m,
    to: ` * Plugin Name:       ${name}`,
  });

  // Plugin's main file - rename it.
  await fs.rename(
    path.join(fullPath, 'wp-boilerplate-plugin.php'),
    path.join(fullPath, `${packageName}.php`),
    function(err) {
      if (err) {
        throw err;
      }
    }
  );

  // Replace all the things.
  await findReplace('WP Boilerplate Plugin', name);
  await findReplace('wp-boilerplate-plugin', packageName);
  await findReplace('WP_Boilerplate_Plugin', namespace);

  // Let's also rename the folder name once we're done with everything else.
  await fs.rename(
    fullPath,
    fullPath.replace('wp-boilerplate-plugin', packageName),
    function(err) {
      if (err) {
        throw err;
      }
    }
  );
};
