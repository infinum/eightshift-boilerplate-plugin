<?php
/**
 * File containing the asset aware interface
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Assets
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Assets;

/**
 * Assets Aware interface.
 */
interface Assets_Aware {
  /**
   * Set the assets handler to use within this object.
   *
   * @param Assets_Handler $assets Assets handler to use.
   */
  public function with_assets_handler( Assets_Handler $assets );
}
