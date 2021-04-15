<?php

/**
 * The file that defines a factory for activating / deactivating plugin.
 *
 * @package EightshiftBoilerplate
 */

declare(strict_types=1);

namespace EightshiftBoilerplate;

/**
 * The plugin factory class.
 */
class PluginFactory
{

	/**
	 * Activate the plugin.
	 */
	public static function activate(): void
	{
		(new Activate())->activate();
	}

	/**
	 * Activate the plugin.
	 */
	public static function deactivate(): void
	{
		(new Deactivate())->deactivate();
	}
}
