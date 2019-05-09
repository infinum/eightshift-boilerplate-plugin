<?php
/**
 * File containing the asset interface
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Assets
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Assets;

use WP_Boilerplate_Plugin\Core\Registerable;

/**
 * Asset interface.
 */
interface Asset extends Registerable {

  /**
   * Enqueue the asset.
   *
   * @return void
   */
  public function enqueue();

  /**
   * Get the handle of the asset.
   *
   * @return string
   */
  public function get_handle();
}
