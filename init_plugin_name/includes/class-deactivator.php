<?php
/**
 * Fired during plugin deactivation
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since   1.0.0
 * @package init_plugin_name
 */

namespace Inf_Plugin\Includes;

/**
 * Class Deactivator
 */
class Deactivator {

  /**
   * Flush permalinks
   *
   * @since 1.0.0
   */
  public static function deactivate() {
    flush_rewrite_rules();
  }
}
