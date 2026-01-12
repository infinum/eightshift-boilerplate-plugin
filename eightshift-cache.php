<?php

/**
 * File used to build cache from terminal in deploy process.
 *
 * @package EightshiftBoilerplatePlugin
 */

declare(strict_types=1);

namespace EightshiftBoilerplatePlugin;

use EightshiftBoilerplatePlugin\Cache\ManifestCache;
use EightshiftBoilerplatePlugin\Main\Main;

require_once \dirname(__DIR__, 3) . '/wp-load.php';

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

/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 */
if (\class_exists(Main::class) && \class_exists(ManifestCache::class)) {
	(new ManifestCache())->setAllCache();
	(new Main($loader->getPrefixesPsr4(), __NAMESPACE__))->registerServices();
}
