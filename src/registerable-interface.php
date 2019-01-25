<?php
/**
 * File that holds the registerable interface.
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Core
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Core;

/**
 * Interface Registerable.
 *
 * An object that can be registered.
 *
 * @since 1.0.0
 */
interface Registerable {

  /**
   * Register the current Registerable.
   *
   * A register method holds the plugin action and filter hooks.
   * Following the single responsibility principle, every class
   * holds a functionality for a certain part of the plugin.
   * This is why every class should hold its own hooks.
   *
   * @return void
   */
  public function register() : void;
}
