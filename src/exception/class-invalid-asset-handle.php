<?php
/**
 * File containing invalid asset handle exception
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Exception
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Exception;

/**
 * Class Invalid_Asset_Handle.
 */
class Invalid_Asset_Handle extends \InvalidArgumentException implements General_Exception {

  /**
   * Create a new instance of the exception for a asset handle that is not
   * valid.
   *
   * @param string $handle Asset handle that is not valid.
   *
   * @return static
   */
  public static function from_handle( string $handle ) {
    $message = sprintf(
      esc_html__( 'The asset handle "%s" is not valid.', 'wp-boilerplate-plugin' ),
      $handle
    );

    return new static( $message );
  }
}
