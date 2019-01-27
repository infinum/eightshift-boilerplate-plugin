<?php
/**
 * View class file
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\View
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\View;

use WP_Boilerplate_Plugin\Exception\Failed_To_Load_View;
use WP_Boilerplate_Plugin\Exception\Invalid_URI;
use WP_Boilerplate_Plugin\Core\Renderable;

/**
 * Interface View.
 *
 * @package schlessera/wcbtn-2018-api
 */
interface View extends Renderable {

  /**
   * Render a given URI.
   *
   * @param array $context Context in which to render.
   *
   * @return string Rendered HTML.
   * @throws Failed_To_Load_View If the View URI could not be loaded.
   */
  public function render( array $context = [] ) : string;

  /**
   * Render a partial view.
   *
   * This can be used from within a currently rendered view, to include
   * nested partials.
   *
   * The passed-in context is optional, and will fall back to the parent's
   * context if omitted.
   *
   * @param string     $uri     URI of the partial to render.
   * @param array|null $context Context in which to render the partial.
   *
   * @return string              Rendered HTML.
   * @throws Invalid_URI         If the provided URI was not valid.
   * @throws Failed_To_Load_View If the view could not be loaded.
   */
  public function render_partial( $uri, array $context = null ) : string;
}
