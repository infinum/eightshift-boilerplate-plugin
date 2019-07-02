<?php
/**
 * Enqueue resources class file
 *
 * @since 1.1.0 Added Assets interface
 * @package WP_Boilerplate_Plugin\Enqueue
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Enqueue;

/**
 * Enqueue resources class
 *
 * Class that will handle enqueueing and registering scripts and styles
 */
class Enqueue_Resources implements Assets {

  const JS_HANDLE = 'wp-boilerplate-plugin-js';
  const JS_URI    = 'application.js';

  const CSS_HANDLE = 'wp-boilerplate-plugin-css';
  const CSS_URI    = 'application.css';

  const VERSION   = false;
  const IN_FOOTER = false;

  const MEDIA_ALL    = 'all';
  const MEDIA_PRINT  = 'print';
  const MEDIA_SCREEN = 'screen';

  /**
   * Register the admin menu.
   */
  public function register() {
    add_action( 'login_enqueue_scripts', [ $this, 'enqueue_styles' ] );
    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
    add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
  }

  /**
   * Register admin area styles
   *
   * @since 1.1.0
   */
  public function enqueue_styles() {
    wp_register_style(
      self::CSS_HANDLE,
      $this->get_manifest_assets_data( self::CSS_URI ),
      [],
      self::VERSION,
      self::MEDIA_ALL
    );

    wp_enqueue_style( self::CSS_HANDLE );
  }

  /**
   * Register admin area scripts
   *
   * @since 1.1.0
   */
  public function enqueue_scripts() {
    // All other scripts.
    wp_register_script(
      self::JS_HANDLE,
      $this->get_manifest_assets_data( self::JS_URI ),
      $this->get_js_dependencies(),
      self::VERSION,
      self::IN_FOOTER
    );

    wp_enqueue_script( self::JS_HANDLE );

    foreach ( $this->get_localizations() as $object_name => $data_array ) {
      wp_localize_script( self::JS_HANDLE, $object_name, $data_array );
    }
  }

  /**
   * Get script dependencies
   *
   * @link https://developer.wordpress.org/reference/functions/wp_enqueue_script/#default-scripts-included-and-registered-by-wordpress
   *
   * @return array List of all the script dependencies
   */
  protected function get_js_dependencies() : array {
    return [ 'jquery' ];
  }

  /**
   * Get script localizations
   *
   * @return array Key value pair of different localizations
   */
  protected function get_localizations() : array {
    return [];
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

    return isset( $data[ $key ] ) ? $data[ $key ] : '';
  }
}
