<?php
/**
 * File that holds the assets interface
 *
 * Used for assets enqueueing
 *
 * @since 1.1.0
 * @package WP_Boilerplate_Plugin\Enqueue
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Enqueue;

use WP_Boilerplate_Plugin\Core\Registrable;

/**
 * Assets interface.
 *
 * Interface used for enqueueing assets
 *
 * @since 1.4.0
 */
interface Assets extends Registrable {

  /**
   * Enqueue styles
   *
   * @since 1.4.0
   */
  public function enqueue_styles();

  /**
   * Enqueue scripts
   *
   * @since 1.4.0
   */
  public function enqueue_scripts();
}
