<?php

/**
 * Plugin Name: Eightshift Boilerplate Title
 * Plugin URI:
 * Description: Eightshift Boilerplate Description
 * Author: Team Eightshift
 * Author URI: https://eightshift.com/
 * Version: 4.0.0
 * Text Domain: eightshift-boilerplate
 *
 * @package EightshiftBoilerplate
 */

declare(strict_types=1);

namespace EightshiftBoilerplate;

use EightshiftBoilerplate\Main\Main;
use EightshiftBoilerplatePluginVendor\EightshiftLibs\Cli\Cli;

/**
 * If this file is called directly, abort.
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 */
$loader = require __DIR__ . '/vendor/autoload.php';

/**
 * The code that runs during plugin activation.
 */
register_activation_hook(
	__FILE__,
	function () {
		PluginFactory::activate();
	}
);

/**
 * The code that runs during plugin deactivation.
 */
register_deactivation_hook(
	__FILE__,
	function () {
		PluginFactory::deactivate();
	}
);


/**
 * Begins execution of the theme.
 *
 * Since everything within the theme is registered via hooks,
 * then kicking off the theme from this point in the file does
 * not affect the page life cycle.
 */
if (class_exists(Main::class)) {
	(new Main($loader->getPrefixesPsr4(), __NAMESPACE__))->register();
}

/**
 * Run all WPCLI commands.
 */
if (class_exists(Cli::class)) {
	(new Cli())->load('boilerplate');
}
