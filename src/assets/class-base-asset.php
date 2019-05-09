<?php
/**
 * File containing the base asset abstract class
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Assets
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Assets;

use Closure;

/**
 * Abstract class Base Asset.
 *
 * This abstract class is used for extending the scripts and styles assets.
 */
abstract class Base_Asset implements Asset {

  const REGISTER_PRIORITY = 1;
  const ENQUEUE_PRIORITY  = 10;

  /**
   * Handle of the asset.
   *
   * @var string
   */
  protected $handle;

  /**
   * Get the handle of the asset.
   *
   * @return string
   */
  public function get_handle() : string {
    return $this->handle;
  }

  /**
   * Register the current Registerable.
   *
   * @return void
   */
  public function register() : void {
    $this->deferred_action(
      $this->get_register_action(),
      $this->get_register_closure(),
      static::REGISTER_PRIORITY
    );
  }

  /**
   * Enqueue the asset.
   *
   * @return void
   */
  public function enqueue() : void {
    $this->deferred_action(
      $this->get_enqueue_action(),
      $this->get_enqueue_closure(),
      static::ENQUEUE_PRIORITY
    );
  }

  /**
   * Check that the URI has the correct extension.
   *
   * Optionally adds the extension if none was detected.
   *
   * @param string $uri       URI to check the extension of.
   * @param string $extension Extension to use.
   *
   * @return string URI with correct extension.
   */
  public function check_extension( $uri, $extension ) {
    $detected_extension = pathinfo( $uri, PATHINFO_EXTENSION );

    if ( $extension !== $detected_extension ) {
      $uri .= '.' . $extension;
    }

    return $uri;
  }

  /**
   * Get the enqueue closure to use.
   *
   * @return Closure
   */
  abstract protected function get_register_closure() : Closure;

  /**
   * Get the enqueue closure to use.
   *
   * @return Closure
   */
  abstract protected function get_enqueue_closure() : Closure;

  /**
   * Add a deferred action hook.
   *
   * If the action has already passed, the closure will be called directly.
   *
   * @param string  $action   Deferred action to hook to.
   * @param Closure $closure  Closure to attach to the action.
   * @param int     $priority Optional. Priority to use. Defaults to 10.
   */
  protected function deferred_action( string $action, Closure $closure, int $priority = 10 ) {
    if ( did_action( $action ) ) {
      $closure();

      return;
    }

    add_action(
      $action,
      $closure,
      $priority
    );
  }

  /**
   * Get the register action to use.
   *
   * @return string Register action to use.
   */
  protected function get_register_action() : string {
    return $this->get_enqueue_action();
  }

  /**
   * Get the enqueue action to use.
   *
   * @return string Enqueue action name.
   */
  protected function get_enqueue_action() : string {
    return is_admin() ? 'admin_enqueue_scripts' : 'wp_enqueue_scripts';
  }

  /**
   * Return full path for specific asset from manifest.json
   * This is used for cache busting assets.
   *
   * @param string $key File name key you want to get from manifest.
   * @return string     Full path to asset.
   */
  protected function get_manifest_assets_data( string $key = null ) : string {
    $data = ASSETS_MANIFEST;
    if ( ! $key || $data === null ) {
      return '';
    }

    $data = json_decode( $data, true );

    if ( empty( $data ) ) {
      return '';
    }

    $asset_key = ( gettype( $data ) === 'array' && array_key_exists( $key, $data ) ) ? $data[ $key ] : '';

    $asset = ltrim( $asset_key, '/' );

    return PLUGIN_BASE_URL . $asset;
  }
}
