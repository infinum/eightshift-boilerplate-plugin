import {path} from 'path';
import {replace} from 'replace-in-file'; // eslint-disable-line import/no-extraneous-dependencies

const fullPath = path.join(process.cwd());

/**
 * Performs a wide search & replace.
 *
 * @param {string} findString
 * @param {string} replaceString
 */
export const findReplace = async(findString, replaceString) => {
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

export const replaceThemeData = async({name, packageName, namespace}) => {

  // Replace all the things in paralel.
  await Promise.all([
    findReplace('WP Boilerplate Plugin', name),
    findReplace('wp-boilerplate-plugin', packageName),
    findReplace('WP_Boilerplate_Plugin', namespace),
  ]);
};
