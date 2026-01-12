<?php

/**
 * Plugin Name: Eightshift Boilerplate Plugin
 * Description: This is a minimal plugin boilerplate for the Eightshift WordPress Boilerplate Plugin.
 * Author: Eightshift team
 * Author URI: https://eightshift.com/
 * Version: 6.0.0
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl.html
 * Text Domain: eightshift-boilerplate-plugin
 *
 * @package EightshiftBoilerplatePlugin
 */

declare(strict_types=1);

namespace EightshiftBoilerplatePlugin;

use EightshiftBoilerplatePlugin\Cache\ManifestCache;
use EightshiftBoilerplatePlugin\Main\Main;

/**
 * If this file is called directly, abort
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Bailout, if the theme is not loaded via Composer.
 */
if (!\file_exists(__DIR__ . '/vendor/autoload.php')) {
	return;
}

/**
 * Require the Composer autoloader.
 */
$loader = require __DIR__ . '/vendor/autoload.php';

/**
 * Require the Composer autoloader for the prefixed libraries.
 */
if (\file_exists(__DIR__ . '/vendor-prefixed/autoload.php')) {
	require __DIR__ . '/vendor-prefixed/autoload.php';
}

if (\class_exists(PluginFactory::class)) {
	/**
	 * The code that runs during plugin activation.
	 */
	\register_activation_hook(
		__FILE__,
		function () {
			PluginFactory::activate();
		}
	);

	/**
	 * The code that runs during plugin deactivation.
	 */
	\register_deactivation_hook(
		__FILE__,
		function () {
			PluginFactory::deactivate();
		}
	);
}
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 */
if (\class_exists(Main::class) && \class_exists(ManifestCache::class)) {
	(new ManifestCache())->setAllCache();
	(new Main($loader->getPrefixesPsr4(), __NAMESPACE__))->register();
}
