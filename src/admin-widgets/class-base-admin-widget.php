<?php
/**
 * Admin Widget abstract class file
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Admin_Widgets
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Admin_Widgets;

use WP_Boilerplate_Plugin\Assets\Assets_Aware;
use WP_Boilerplate_Plugin\Assets\Assets_Awareness;
use WP_Boilerplate_Plugin\Core\Renderable;
use WP_Boilerplate_Plugin\Core\Service;
use WP_Boilerplate_Plugin\View\Escaped_View;
use WP_Boilerplate_Plugin\View\Templated_View;

use Closure;

/**
 * Abstract class Base_Admin_Widgets.
 *
 * This abstract class can be extended to add new admin widget
 */
abstract class Base_Admin_Widget implements Renderable, Service, Assets_Aware {

  use Assets_Awareness;

  /**
   * Register the widget.
   */
  public function register() : void {
    if ( ! current_user_can( $this->get_permission_capability() ) ) {
      return;
    }

    $this->register_assets();

    add_action(
      'wp_dashboard_setup',
      function() {
        wp_add_dashboard_widget(
          $this->get_widget_id(),
          $this->get_widget_name(),
          [ $this, 'widget_callback' ],
          [ $this, 'widget_control_callback' ],
          $this->get_widget_callback_args()
        );
      }
    );
  }

  /**
   * Method that fills the widget with the desired content.
   * The method should echo its output.
   *
   * The echo doesn't need to be escaped since it's escaped
   * in the render method.
   *
   * @param array|string $atts Attributes as passed to the dashboard widget.
   *
   * @return void The rendered content needs to be echoed.
   */
  public function widget_callback( $atts ) : void {
    $atts              = $this->process_attributes( $atts );
    $atts['widget_id'] = $this->get_widget_id();

    echo $this->render( (array) $atts ); // phpcs:ignore
  }

  /**
   * Method that outputs controls for the widget.
   *
   * Optional.
   *
   * The echo doesn't need to be escaped since it's escaped
   * in the render method.
   *
   * @param array|string $atts Attributes as passed to the admin menu.
   */
  public function widget_control_callback( $atts ) {
    return null;
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
      // into the admin menu.
      return sprintf(
        '<pre>%s</pre>',
        $exception->getMessage()
      );
    }
  }

  /**
   * Get the widget ID (used in the 'id' attribute for the widget).
   *
   * @return string The widget ID.
   */
  abstract protected function get_widget_id() : string;

  /**
   * Get the name (title) of the widget
   *
   * @return string The title of the widget.
   */
  abstract protected function get_widget_name() : string;

  /**
   * Get the widget callback arguments
   *
   * @return array Data that should be set as the $args property
   * of the widget array (which is the second parameter passed to your callback.
   */
  protected function get_widget_callback_args() : array {
    return [];
  }

  /**
   * Get the View URI to use for rendering the widget.
   *
   * @return string View URI.
   */
  abstract protected function get_view_uri() : string;

  /**
   * Process the widget attributes.
   *
   * @param array|string $atts Raw widget attributes passed into the
   *                           widget render function.
   *
   * @return array Processed widget attributes.
   */
  abstract protected function process_attributes( $atts ) : array;

  /**
   * Get the capability for which the widget can be shown
   *
   * @return string Capability name.
   * @link https://codex.wordpress.org/Roles_and_Capabilities
   */
  abstract protected function get_permission_capability() : string;
}
