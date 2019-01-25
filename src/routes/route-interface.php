<?php
/**
 * File containing type interface
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Routes
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Routes;

use WP_Boilerplate_Plugin\Core\Service;

/**
 * Route interface that adds routes
 */
interface Route extends Service {
    /**
     * Alias for GET transport method.
     *
     * @since 1.0.0
     * @var string
     */
    const READABLE = 'GET';

    /**
     * Alias for POST transport method.
     *
     * @since 1.0.0
     * @var string
     */
    const CREATABLE = 'POST';

    /**
     * Alias for PATCH transport method.
     *
     * @since 1.0.0
     * @var string
     */
    const EDITABLE = 'PATCH';

    /**
     * Alias for PUT transport method.
     *
     * @since 1.0.0
     * @var string
     */
    const UPDATEABLE = 'PUT';

    /**
     * Alias for DELETE transport method.
     *
     * @since 1.0.0
     * @var string
     */
    const DELETABLE = 'DELETE';

  /**
   * Method for adding custom routes
   */
  public function add_routes();
}
