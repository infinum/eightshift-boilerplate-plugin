<?php

/**
 * Plugin Name: Eightshift Boilerplate Setup Plugin
 * Description: This is a initial setup for the Eightshift WordPress Boilerplate Plugin.
 * Author: Eightshift team
 * Author URI: https://eightshift.com/
 * Version: 5.0.0
 * License: MIT
 * License URI: http://www.gnu.org/licenses/gpl.html
 * Text Domain: eightshift-boilerplate-plugin
 *
 * @package EightshiftBoilerplatePlugin
 */

declare(strict_types=1);

namespace EightshiftBoilerplatePlugin;

use EightshiftLibs\Cli\Cli;

/**
 * If this file is called directly, abort.
 */
if (! \defined('WPINC')) {
	die;
}

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 */
if (!\file_exists(__DIR__ . '/vendor/autoload.php')) {
	return;
}

require __DIR__ . '/vendor/autoload.php';

/**
 * Run all WPCLI commands.
 */
if (class_exists(Cli::class)) {
	(new Cli())->load('boilerplate');
}
