<?php
/**
 * File containing the style assets class
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Assets
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Assets;

use Closure;

/**
 * Class Style Asset used for enqueueing styles
 */
class Style_Asset extends Base_Asset {

  const MEDIA_ALL    = 'all';
  const MEDIA_PRINT  = 'print';
  const MEDIA_SCREEN = 'screen';

  /**
   * Default extension name
   *
   * @var string
   */
  const DEFAULT_EXTENSION = 'css';

  /**
   * Source location of the asset.
   *
   * @var string
   */
  protected $source;

  /**
   * Dependencies of the asset.
   *
   * @var array<string>
   */
  protected $dependencies;

  /**
   * Version of the asset.
   *
   * @var string|bool|null
   */
  protected $version;

  /**
   * Media for which the asset is defined.
   *
   * @var string
   */
  protected $media;

  /**
   * Instantiate a Style_Asset object.
   *
   * @param string           $handle       Handle of the asset.
   * @param string           $source       Source location of the asset.
   * @param array            $dependencies Optional. Dependencies of the
   *                                       asset.
   * @param string|bool|null $version      Optional. Version of the asset.
   * @param string           $media        Media for which the asset is
   *                                       defined.
   */
  public function __construct(
    $handle,
    $source,
    $dependencies = [],
    $version = false,
    $media = self::MEDIA_ALL
  ) {
    $this->handle       = $handle;
    $this->source       = $this->get_manifest_assets_data( $source );
    $this->dependencies = (array) $dependencies;
    $this->version      = $version;
    $this->media        = $media;
  }

  /**
   * Get the enqueue closure to use.
   *
   * @return Closure
   */
  protected function get_register_closure() : Closure {
    return function() {
      if ( wp_script_is( $this->handle, 'registered' ) ) {
        return;
      }

      wp_register_style(
        $this->handle,
        $this->source,
        $this->dependencies,
        $this->version,
        $this->media
      );
    };
  }

  /**
   * Get the enqueue closure to use.
   *
   * @return Closure
   */
  protected function get_enqueue_closure() : Closure {
    return function() {
      wp_enqueue_style( $this->handle );
    };
  }
}
