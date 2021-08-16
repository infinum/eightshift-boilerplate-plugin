<?php

/**
 * The file that defines actions on plugin activation.
 *
 * @package EightshiftBoilerplate
 */

declare(strict_types=1);

namespace EightshiftBoilerplate;

use EightshiftBoilerplateVendor\EightshiftLibs\Plugin\HasActivationInterface;

/**
 * The plugin activation class.
 *
 * @since 1.0.0
 */
class Activate implements HasActivationInterface
{

	/**
	 * Activate the plugin.
	 *
	 * @since 1.0.0
	 */
	public function activate(): void
	{
		\flush_rewrite_rules();
	}
}
