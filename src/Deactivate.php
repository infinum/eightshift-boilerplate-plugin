<?php

/**
 * The file that defines actions on plugin deactivation
 *
 * @package EightshiftBoilerplatePlugin
 */

declare(strict_types=1);

namespace EightshiftBoilerplatePlugin;

use EightshiftBoilerplatePluginVendor\EightshiftLibs\Plugin\HasDeactivationInterface;

/**
 * The plugin deactivation class
 */
class Deactivate implements HasDeactivationInterface
{
	/**
	 * Deactivate the plugin
	 *
	 * @return void
	 */
	public function deactivate(): void
	{
		\flush_rewrite_rules();
	}
}
