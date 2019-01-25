<?php
/**
 * File containing the assets awareness trait
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Assets
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Assets;

use WP_Boilerplate_Plugin\Exception\Invalid_Asset_Handle;

/**
 * Trait Assets_Awareness
 */
trait Assets_Awareness {

  /**
   * Assets handler instance to use.
   *
   * @var assets_handler
   */
  protected $assets_handler;

  /**
   * Get the array of known assets.
   *
   * @return array
   */
  protected function get_assets() : array {
    return [];
  }

  /**
   * Register the known assets.
   */
  protected function register_assets() {
    foreach ( $this->get_assets() as $asset ) {
      $this->assets_handler->add( $asset );
    }
  }

  /**
   * Enqueue the known assets.
   *
   * @throws Invalid_Asset_Handle If the passed-in asset handle is not valid.
   */
  protected function enqueue_assets() {
    foreach ( $this->get_assets() as $asset ) {
      $this->assets_handler->enqueue( $asset );
    }
  }

  /**
   * Enqueue a single asset.
   *
   * @param string $handle Handle of the asset to enqueue.
   *
   * @throws Invalid_Asset_Handle If the passed-in asset handle is not valid.
   */
  protected function enqueue_asset( $handle ) {
    $this->assets_handler->enqueue_handle( $handle );
  }

  /**
   * Set the assets handler to use within this object.
   *
   * @param Assets_Handler $assets Assets handler to use.
   */
  public function with_assets_handler( Assets_Handler $assets ) {
    $this->assets_handler = $assets;
  }
}
