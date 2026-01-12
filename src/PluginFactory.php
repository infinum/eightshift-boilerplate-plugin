<?php

/**
 * The file that defines a factory for activating / deactivating plugin
 *
 * @package EightshiftBoilerplatePlugin
 */

declare(strict_types=1);

namespace EightshiftBoilerplatePlugin;

use EightshiftBoilerplatePlugin\Main\Main;

/**
 * The plugin factory class
 */
final class PluginFactory
{
	/**
	 * Activate the plugin
	 *
	 * @return void
	 */
	public static function activate(): void
	{
		(new Activate())->activate();
	}

	/**
	 * Deactivate the plugin
	 *
	 * @return void
	 */
	public static function deactivate(): void
	{
		(new Deactivate())->deactivate();
	}

	/**
	 * Create and return an instance of the plugin.
	 *
	 * This always returns a shared instance.
	 *
	 * @param array<string, string[]> $prefixes List of PSR-4 prefixes.
	 * @param string $namespace Main plugin namespace.
	 *
	 * @return Main Plugin instance.
	 */
	public static function create(array $prefixes, string $namespace): Main
	{
		static $plugin = null;

		if ($plugin === null) {
			$plugin = new Main($prefixes, $namespace);
		}

		return $plugin;
	}
}
