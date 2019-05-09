<?php
/**
 * The class file that contains method for user login
 *
 * @since   1.5.0
 * @package WP_Boilerplate_Plugin\Routes\Rest_Callback
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Routes\Rest_Callback;

use WP_Boilerplate_Plugin\Routes\Rest_Callable;

/**
 * Class Example
 *
 * Class that handles callback for example REST route.
 */
class Example implements Rest_Callable {

  /**
   * Example REST callback
   *
   * This callback is triggered when a front end app
   * goes to the @link https://API-URL/wp-json/wp-boilerplate-plugin/v1/example
   * endpoint.
   *
   * Defined in: WP_Boilerplate_Plugin\Rest\Rest_Register
   * Call method type: GET
   *
   * @api
   *
   * @param \WP_REST_Request $request Full data about the request.
   * @return array|\WP_Error          Array that will be converted to JSON when passed to endpoint.
   *
   * @since 1.0.0
   */
  public function rest_callback( \WP_REST_Request $request ) {
    return \rest_ensure_response( [ 'Example' ] );
  }
}
