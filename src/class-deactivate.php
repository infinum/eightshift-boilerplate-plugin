<?php
/**
 * The file that defines actions on plugin deactivation.
 *
 * @since   1.0.0
 * @package Eightshift_Boilerplate\Core
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Core;

use Eightshift_Libs\Core\Has_Deactivation;

/**
 * The plugin deactivation class.
 *
 * @since 1.0.0
 */
class Deactivate implements Has_Deactivation {

  /**
   * Deactivate the plugin.
   *
   * @since 1.0.0
   */
  public function deactivate() : void {

    \flush_rewrite_rules();
  }
}
