<?php
/**
 * File containing the main plugin class
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Core
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Core;

use WP_Boilerplate_Plugin\Admin_Menus;
use WP_Boilerplate_Plugin\Enqueue;

use WP_Boilerplate_Plugin\Exception;

use Eightshift_Libs\Core\Main as LibMain;


/**
 * Class Plugin.
 *
 * Main plugin controller class that hooks the plugin's functionality
 * into the WordPress request lifecycle.
 *
 * @since 1.0.0
 */
final class Plugin extends LibMain {

  /**
   * Array of instantiated services.
   *
   * @var Service[]
   */
  private $services = [];

  /**
   * Activate the plugin.
   */
  public function activate() {
    if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
      include ABSPATH . '/wp-admin/includes/plugin.php';
    }

    $this->register_services();

    // Activate that which can be activated.
    foreach ( $this->services as $service ) {
      if ( $service instanceof Has_Activation ) {
        $service->activate();
      }
    }

    \flush_rewrite_rules();
  }

  /**
   * Deactivate the plugin.
   */
  public function deactivate() {
    $this->register_services();

    // Deactivate that which can be deactivated.
    foreach ( $this->services as $service ) {
      if ( $service instanceof Has_Deactivation ) {
        $service->deactivate();
      }
    }

    \flush_rewrite_rules();
  }

  /**
   * Register the plugin with the WordPress hooks system.
   *
   * @return void
   *
   * @since 1.0.0
   */
  public function register() {
    parent::register();

    $this->register_assets_manifest_data();
  }

  /**
   * Returns the plugin init hook name
   *
   * @return string
   *
   * @since 1.0.0
   */
  public function get_register_action_hook() : string {
    return 'plugins_loaded';
  }

  /**
   * Register bundled asset manifest
   *
   * @throws Exception\Missing_Manifest Throws error if manifest is missing.
   * @return void
   */
  public function register_assets_manifest_data() {

    // phpcs:disable
    $response = file_get_contents( rtrim( plugin_dir_path( __DIR__ ), '/' ) . '/assets/public/manifest.json' );
    // phpcs:enable

    if ( ! $response ) {
      $error_message = esc_html__( 'manifest.json is missing. Bundle the plugin before using it.', 'wp-boilerplate-plugin' );
      throw Exception\Missing_Manifest::message( $error_message );
    }

    define( 'ASSETS_MANIFEST', (string) $response );
  }

  /**
   * Get the list of services to register.
   *
   * A list of classes which contain hooks.
   *
   * @return array<string> Array of fully qualified class names.
   */
  protected function get_service_classes() : array {
    return [
      Enqueue\Enqueue_Resources::class,
      Admin_Menus\Plugin_Options::class,
    ];
  }
}
