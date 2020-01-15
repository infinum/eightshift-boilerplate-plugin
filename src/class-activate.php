<?php
/**
 * The file that defines actions on plugin activation.
 *
 * @since   1.0.0
 * @package Eightshift_Boilerplate\Core
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Core;

use Eightshift_Libs\Core\Has_Activation;

/**
 * The plugin activation class.
 *
 * @since 1.0.0
 */
class Activate implements Has_Activation {

  /**
   * Activate the plugin.
   *
   * @since 1.0.0
   */
  public function activate() : void {

    \flush_rewrite_rules();
  }
}
