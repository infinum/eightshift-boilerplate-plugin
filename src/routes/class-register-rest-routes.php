<?php
/**
 * File containing registered routes
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Routes
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Routes;

use WP_Boilerplate_Plugin\Exception;
use WP_Boilerplate_Plugin\Routes\Route;
use WP_Boilerplate_Plugin\Routes\Rest_Callback;

use \WP_REST_Server;

/**
 * Class used for registering custom rest callbacks
 */
class Register_Rest_Routes implements Route {

  const NAMESPACE = 'wp-boilerplate-plugin';

  const VERSION = '/v1';

  /**
   * Route names
   */
  const EXAMPLE = '/example';
  /**
   * Callback class names
   */
  const EXAMPLE_CLASS = Rest_Callback\Example::class;

  /**
   * Register the custom rest routes.
   *
   * Registers the routes on rest_api_init.
   *
   * @throws Exception\Invalid_Service If a service is not valid.
   */
  public function register() : void {
    add_action( 'rest_api_init', [ $this, 'add_routes' ] );
  }

  /**
   * Method which registers all the rest routes
   *
   * Uses register_rest_route() to register custom routes
   */
  public function add_routes() {
    register_rest_route(
      self::NAMESPACE . self::VERSION,
      self::LOGIN,
      array(
        'methods'  => static::READABLE,
        'callback' => $this->get_callback( self::EXAMPLE_CLASS ),
      )
    );
  }

  /**
   * Get callback for every registered route
   *
   * @param  string $class              Class name which holds the callback.
   * @throws Exception\Invalid_Callback If the callback is not valid.
   * @return callable                   Returns the Rest callback for the certain callback.
   */
  public function get_callback( string $class ) : callable {
    if ( ! class_exists( $class ) ) {
      throw Exception\Invalid_Callback::from_callback( $class );
    }

    $response_class = new $class();

    if ( ! $response_class instanceof Rest_Callable ) {
      throw Exception\Invalid_Callback::from_callback( $response_class );
    }

    return [ $response_class, 'rest_callback' ];
  }
}
