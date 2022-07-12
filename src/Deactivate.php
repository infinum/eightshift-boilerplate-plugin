<?php

/**
 * The file that defines actions on plugin deactivation.
 *
 * @package EightshiftBoilerplate
 */

declare(strict_types=1);

namespace EightshiftBoilerplate;

use EightshiftBoilerplatePluginVendor\EightshiftLibs\Plugin\HasDeactivationInterface;

/**
 * The plugin deactivation class.
 */
class Deactivate implements HasDeactivationInterface
{

	/**
	 * Deactivate the plugin.
	 */
	public function deactivate(): void
	{
		\flush_rewrite_rules();
	}
}
