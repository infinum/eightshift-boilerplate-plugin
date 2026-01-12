<?php

/**
 * The file that defines the main entrypoint class
 *
 * A class definition that includes attributes and functions used across both the
 * front-facing side of the site and the admin area.
 *
 * @package EightshiftBoilerplatePlugin\Main
 */

declare(strict_types=1);

namespace EightshiftBoilerplatePlugin\Main;

use EightshiftBoilerplatePluginVendor\EightshiftLibs\Main\AbstractMain;

/**
 * The main entrypoint class
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 */
class Main extends AbstractMain
{
	/**
	 * Register the project with the WordPress system
	 *
	 * The register_service method will call the register() method in every service class,
	 * which holds the actions and filters - effectively replacing the need to manually add
	 * them in one place.
	 *
	 * @return void
	 */
	public function register(): void
	{
		\add_action('plugins_loaded', [$this, 'registerServices']);
	}
}
