<?php
/**
 * File containing the script assets class
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Assets
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Assets;

use Closure;

/**
 * Class Script Asset used for enqueueing scripts
 */
class Script_Asset extends Base_Asset {

  const ENQUEUE_HEADER = false;
  const ENQUEUE_FOOTER = true;

  /**
   * Default extension name
   *
   * @var string
   */
  const DEFAULT_EXTENSION = 'js';

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
   * Whether to enqueue the script in the footer.
   *
   * @var bool
   */
  protected $in_footer;

  /**
   * Localization data that is added to the JS space.
   *
   * @var array
   */
  protected $localizations = [];

  /**
   * Instantiate a Script_Asset object.
   *
   * @param string           $handle       Handle of the asset.
   * @param string           $source       Source location of the asset.
   * @param array            $dependencies Optional. Dependencies of the
   *                                       asset.
   * @param string|bool|null $version      Optional. Version of the asset.
   * @param bool             $in_footer    Whether to enqueue the asset in
   *                                       the footer.
   */
  public function __construct(
    $handle,
    $source,
    $dependencies = [],
    $version = false,
    $in_footer = self::ENQUEUE_HEADER
  ) {
    $this->handle       = $handle;
    $this->source       = $this->get_manifest_assets_data( $source );
    $this->dependencies = (array) $dependencies;
    $this->version      = $version;
    $this->in_footer    = $in_footer;
  }

  /**
   * Add a localization to the script.
   *
   * @param string $object_name Name of the object to create in JS space.
   * @param array  $data_array  Array of data to attach to the object.
   *
   * @return static
   */
  public function add_localization( $object_name, $data_array ) {
    $this->localizations[ $object_name ] = $data_array;

    return $this;
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

      wp_register_script(
        $this->handle,
        $this->source,
        $this->dependencies,
        $this->version,
        $this->in_footer
      );

      foreach ( $this->localizations as $object_name => $data_array ) {
        wp_localize_script( $this->handle, $object_name, $data_array );
      }
    };
  }

  /**
   * Get the enqueue closure to use.
   *
   * @return Closure
   */
  protected function get_enqueue_closure() : Closure {
    return function() {
      wp_enqueue_script( $this->handle );
    };
  }
}
