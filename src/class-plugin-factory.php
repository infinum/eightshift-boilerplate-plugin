<?php
/**
 * Factory pattern that creates a plugin instance
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Core
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Core;

/**
 * Class Plugin_Factory
 *
 * Creates a plugin instance
 *
 * @since 1.0.0
 */
final class Plugin_Factory {
  /**
   * Create and return an instance of the plugin.
   *
   * This always returns a shared instance.
   *
   * @return Plugin Plugin instance.
   */
  public static function create() : Plugin {
    static $plugin = null;

    if ( $plugin === null ) {
      $plugin = new Plugin();
    }

    return $plugin;
  }
}
