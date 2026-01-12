<?php

/**
 * The file that defines actions on plugin activation
 *
 * @package EightshiftBoilerplatePlugin
 */

declare(strict_types=1);

namespace EightshiftBoilerplatePlugin;

use EightshiftBoilerplatePluginVendor\EightshiftLibs\Plugin\HasActivationInterface;

/**
 * The plugin activation class
 */
class Activate implements HasActivationInterface
{
	/**
	 * Activate the plugin
	 *
	 * @return void
	 */
	public function activate(): void
	{
		\flush_rewrite_rules();
	}
}
