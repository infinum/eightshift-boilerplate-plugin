<?php
/**
 * Metabox abstract class file
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Metabox
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Metabox;

use WP_Boilerplate_Plugin\Assets\Assets_Aware;
use WP_Boilerplate_Plugin\Assets\Assets_Awareness;
use WP_Boilerplate_Plugin\Core\Renderable;
use WP_Boilerplate_Plugin\Core\Service;
use WP_Boilerplate_Plugin\View\Escaped_View;
use WP_Boilerplate_Plugin\View\Templated_View;

use Closure;

/**
 * Abstract class Base_Metabox.
 */
abstract class Base_Metabox implements Renderable, Service, Assets_Aware {

  use Assets_Awareness;

  const CONTEXT_ADVANCED = 'advanced';
  const CONTEXT_NORMAL   = 'normal';
  const CONTEXT_SIDE     = 'side';

  const PRIORITY_DEFAULT = 'default';
  const PRIORITY_HIGH    = 'high';
  const PRIORITY_LOW     = 'low';

  /**
   * Register the Metabox.
   */
  public function register() : void {
    $this->register_assets();
    $this->register_persistence_hooks();

    add_action(
      'add_meta_boxes',
      function() {
        add_meta_box(
          $this->get_id(),
          $this->get_title(),
          [ $this, 'process_metabox' ],
          $this->get_screen(),
          $this->get_context(),
          $this->get_priority(),
          $this->get_callback_args()
        );
      }
    );
  }

  /**
   * Process the metabox attributes and prepare rendering.
   *
   * @param array|string $atts Attributes as passed to the metabox.
   *
   * @return void The rendered content needs to be echoed.
   */
  public function process_metabox( $atts ) : void {
    $atts                = $this->process_attributes( $atts );
    $atts['metabox_id']  = $this->get_id();
    $atts['nonce_field'] = $this->render_nonce();

    echo $this->render( (array) $atts ); // phpcs:ignore
  }

  /**
   * Render the current Renderable.
   *
   * @param array $context Context in which to render.
   *
   * @return string Rendered HTML.
   */
  public function render( array $context = [] ) : string {
    try {
      $this->enqueue_assets();

      $view = new Escaped_View(
        new Templated_View( $this->get_view_uri() )
      );

      return $view->render( $context );
    } catch ( \Exception $exception ) {
      // Don't let exceptions bubble up. Just render the exception message
      // into the metabox.
      return sprintf(
        '<pre>%s</pre>',
        $exception->getMessage()
      );
    }
  }

  /**
   * Do the actual persistence of the changed data.
   *
   * @param int $post_id ID of the post to persist.
   *
   * @return void
   */
  abstract protected function persist( int $post_id ) : void;

  /**
   * Get the View URI to use for rendering the metabox.
   *
   * @return string View URI.
   */
  abstract protected function get_view_uri() : string;

  /**
   * Process the metabox attributes.
   *
   * @param array|string $atts Raw metabox attributes passed into the
   *                           metabox function.
   *
   * @return array Processed metabox attributes.
   */
  abstract protected function process_attributes( $atts ) : array;

  /**
   * Get the ID to use for the metabox.
   *
   * @return string ID to use for the metabox.
   */
  abstract protected function get_id() : string;

  /**
   * Get the title to use for the metabox.
   *
   * @return string Title to use for the metabox.
   */
  abstract protected function get_title() : string;

  /**
   * Render the nonce.
   *
   * @return string Hidden field with a nonce.
   */
  protected function render_nonce() : string {
    ob_start();

    wp_nonce_field(
      $this->get_nonce_action(),
      $this->get_nonce_name()
    );

    return ob_get_clean();
  }

  /**
   * Verify the nonce and return the result.
   *
   * @return bool Whether the nonce could be successfully verified.
   */
  protected function verify_nonce() : bool {
    $nonce_name = $this->get_nonce_name();

    if ( ! array_key_exists( $nonce_name, $_POST ) ) { // phpcs:ignore
      return false;
    }

    $nonce = $_POST[ $nonce_name ]; // phpcs:ignore

    $result = wp_verify_nonce(
      $nonce,
      $this->get_nonce_action()
    );

    return false !== $result;
  }

  /**
   * Get the action of the nonce to use.
   *
   * @return string Action of the nonce.
   */
  protected function get_nonce_action() : string {
    return "{$this->get_id()}_action";
  }

  /**
   * Get the name of the nonce to use.
   *
   * @return string Name of the nonce.
   */
  protected function get_nonce_name() : string {
    return "{$this->get_id()}_nonce";
  }

  /**
   * Get the screen on which to show the metabox.
   *
   * @return string|array|\WP_Screen Screen on which to show the metabox.
   */
  protected function get_screen() {
    return null;
  }

  /**
   * Get the context in which to show the metabox.
   *
   * @return string Context to use.
   */
  protected function get_context() : string {
    return static::CONTEXT_ADVANCED;
  }

  /**
   * Get the priority within the context where the boxes should show.
   *
   * @return string Priority within context.
   */
  protected function get_priority() : string {
    return static::PRIORITY_DEFAULT;
  }

  /**
   * Get the array of arguments to pass to the render callback.
   *
   * @return array Array of arguments.
   */
  protected function get_callback_args() : array {
    return [];
  }

  /**
   * Register the persistence hooks to be triggered by a save attempt.
   *
   * @return void Save action hook.
   */
  protected function register_persistence_hooks() : void {
    $closure = $this->get_persistence_closure();
    add_action( 'save_post', $closure );
  }

  /**
   * Return the persistence closure.
   *
   * @return Closure
   */
  protected function get_persistence_closure() : Closure {
    return function( $post_id ) {
      // Verify nonce and bail early if it doesn't verify.
      if ( ! $this->verify_nonce() ) {
        return $post_id;
      }

      // Bail early if this is an autosave.
      if ( wp_is_post_autosave( $post_id ) ) {
        return $post_id;
      }

      // Bail early if this is a revision.
      if ( wp_is_post_revision( $post_id ) ) {
        return $post_id;
      }

      // Check the user's permissions.
      if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return $post_id;
      }

      // Check if there was a multisite switch before.
      if ( is_multisite() && ms_is_switched() ) {
        return $post_id;
      }

      $this->persist( $post_id );

      return $post_id;
    };
  }
}
