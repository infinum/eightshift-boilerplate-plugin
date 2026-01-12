<?php

/**
 * The file that holds config class
 *
 * @package EightshiftBoilerplatePlugin\Config
 */

declare(strict_types=1);

namespace EightshiftBoilerplatePlugin\Config;

use EightshiftBoilerplatePluginVendor\EightshiftLibs\Helpers\Helpers;

/**
 * The plugin config class
 *
 * Used to provide certain config strings for REST API or style and scripts.
 *
 * @package EightshiftSso\Blocks
 */
class Config
{
	/**
	 * Method that returns project name.
	 *
	 * Generally used for naming assets handlers, languages, etc.
	 */
	public static function getProjectName(): string
	{
		return Helpers::getPluginName();
	}

	/**
	 * Method that returns project version.
	 *
	 * Generally used for versioning asset handlers while enqueueing them.
	 */
	public static function getProjectVersion(): string
	{
		return Helpers::getPluginVersion();
	}

	/**
	 * Method that returns project text domain.
	 *
	 * Generally used for caching and translations.
	 */
	public static function getProjectTextDomain(): string
	{
		return Helpers::getPluginTextDomain();
	}

	/**
	 * Method that returns project REST-API namespace.
	 *
	 * Used for namespacing projects REST-API routes and fields.
	 *
	 * @return string Project name.
	 */
	public static function getProjectRoutesNamespace(): string
	{
		return Helpers::getPluginTextDomain();
	}

	/**
	 * Method that returns project REST-API version.
	 *
	 * Used for versioning projects REST-API routes and fields.
	 *
	 * @return string Project route version.
	 */
	public static function getProjectRoutesVersion(): string
	{
		return 'v1';
	}
}
