<?php
/**
 * Admin Submenus abstract class file
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Admin_Menus
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Admin_Menus;

use WP_Boilerplate_Plugin\Assets\Assets_Aware;
use WP_Boilerplate_Plugin\Assets\Assets_Awareness;
use WP_Boilerplate_Plugin\Core\Renderable;
use WP_Boilerplate_Plugin\Core\Service;
use WP_Boilerplate_Plugin\View\Escaped_View;
use WP_Boilerplate_Plugin\View\Templated_View;

use Closure;

/**
 * Abstract class Base_Admin_Menus.
 *
 * This abstract class can be extended to add new admin menus
 */
abstract class Base_Admin_Submenu extends Base_Admin_Menu {

  use Assets_Awareness;

  /**
   * Register the submenu.
   */
  public function register() : void {
    $this->register_assets();
    $this->register_persistence_hooks();

    add_action(
      'admin_menu',
      function() {
        add_submenu_page(
          $this->get_parent_menu(),
          $this->get_title(),
          $this->get_menu_title(),
          $this->get_capability(),
          $this->get_menu_slug(),
          [ $this, 'process_admin_submenu' ]
        );
      }
    );
  }

  /**
   * Process the admin submenu attributes and prepare rendering.
   *
   * The echo doesn't need to be escaped since it's escaped
   * in the render method.
   *
   * @param array|string $atts Attributes as passed to the admin menu.
   *
   * @return void The rendered content needs to be echoed.
   */
  public function process_admin_submenu( $atts ) : void {
    $atts                  = $this->process_attributes( $atts );
    $atts['admin_menu_id'] = $this->get_menu_slug();
    $atts['nonce_field']   = $this->render_nonce();

    echo $this->render( (array) $atts ); // phpcs:ignore
  }

  /**
   * Get the slug of the parent menu.
   *
   * @return string The slug name for the parent menu (or the file name of a standard WordPress admin page.
   */
  abstract protected function get_parent_menu() : string;
}
