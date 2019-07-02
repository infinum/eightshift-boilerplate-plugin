<?php
/**
 * Plugin options menu class file
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Admin_Menus
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Admin_Menus;

/**
 * Plugin options menu class
 *
 * Class that renders the plugin options menu page
 */
final class Plugin_Options extends Base_Admin_Menu {

  const CAPABILITY = 'activate_plugins';
  const MENU_SLUG  = 'plugin-settings';
  const MENU_ICON  = 'dashicons-share';

  const VIEW_URI = 'views/plugin-options-page';

  /**
   * Get the title to use for the admin page.
   *
   * @return string The text to be displayed in the title tags of the page when the menu is selected.
   */
  protected function get_title() : string {
    return esc_html__( 'Plugin options', 'wp-boilerplate-plugin' );
  }

  /**
   * Get the menu title to use for the admin menu.
   *
   * @return string The text to be used for the menu.
   */
  protected function get_menu_title() : string {
    return esc_html__( 'Plugin options', 'wp-boilerplate-plugin' );
  }

  /**
   * Get the capability required for this menu to be displayed.
   *
   * @return string The capability required for this menu to be displayed to the user.
   */
  protected function get_capability() : string {
    return self::CAPABILITY;
  }

  /**
   * Get the menu slug.
   *
   * @return string The slug name to refer to this menu by. Should be unique for this menu page and only include lowercase alphanumeric, dashes, and underscores characters to be compatible with sanitize_key().
   */
  protected function get_menu_slug() : string {
    return self::MENU_SLUG;
  }

  /**
   * Get the URL to the icon to be used for this menu
   *
   * @return string The URL to the icon to be used for this menu.
   */
  protected function get_icon() : string {
    return self::MENU_ICON;
  }

  /**
   * Get the View URI to use for rendering the admin menu.
   *
   * @return string View URI.
   */
  protected function get_view_uri() : string {
    return self::VIEW_URI;
  }

  /**
   * Process the admin menu attributes.
   *
   * @param array|string $atts Raw admin menu attributes passed into the
   *                           admin menu function.
   *
   * @return array Processed admin menu attributes.
   */
  protected function process_attributes( $atts ) : array {
    $atts = (array) $atts;

    return $atts;
  }
}
