<?php
/**
 * File containing the main plugin class
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Core
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Core;

use WP_Boilerplate_Plugin\Assets\Assets_Aware;
use WP_Boilerplate_Plugin\Assets\Assets_Handler;

use WP_Boilerplate_Plugin\Admin_Menus;
use WP_Boilerplate_Plugin\Authorization;
use WP_Boilerplate_Plugin\Custom_Post_Type;
use WP_Boilerplate_Plugin\Custom_Taxonomy;
use WP_Boilerplate_Plugin\Routes;

use WP_Boilerplate_Plugin\Exception;

/**
 * Class Plugin.
 *
 * Main plugin controller class that hooks the plugin's functionality
 * into the WordPress request lifecycle.
 *
 * @since 1.0.0
 */
final class Plugin implements Registerable, Has_Activation, Has_Deactivation {

  /**
   * Assets handler instance.
   *
   * @var Assets_Handler
   */
  private $assets_handler;

  /**
   * Array of instantiated services.
   *
   * @var Service[]
   */
  private $services = [];

  /**
   * Instantiate a Plugin object.
   *
   * @param Assets_Handler|null $assets_handler Optional. Instance of the
   *                                           assets handler to use.
   */
  public function __construct( Assets_Handler $assets_handler = null ) {
    $this->assets_handler = $assets_handler ?: new Assets_Handler();
  }

  /**
   * Activate the plugin.
   *
   * @throws Exception\Plugin_Activation_Failure If a condition for plugin activation isn't met.
   */
  public function activate() : void {
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
  public function deactivate() : void {
    $this->register_services();

    // Deactivate that which can be deactivated.
    foreach ( $this->services as $service ) {
      if ( $service instanceof Has_Deactivation ) {
        $service->deactivate();
      }
    }

    // Rebuild old roles on plugin deactivation.
    if ( ! function_exists( 'populate_roles' ) ) {
      require_once ABSPATH . 'wp-admin/includes/schema.php';
    }

    \populate_roles(); // Restore default user roles.
    \flush_rewrite_rules();
  }

  /**
   * Register the plugin with the WordPress system.
   *
   * The register_service method will call the register() method in every service class,
   * which holds the actions and filters - effectively replacing the need to manually add
   * themn in one place.
   *
   * @throws Exception\Invalid_Service If a service is not valid.
   */
  public function register() : void {

    add_action( 'plugins_loaded', [ $this, 'register_services' ] );
    add_action( 'init', [ $this, 'register_assets_handler' ] );

    $this->register_assets_manifest_data();
  }

  /**
   * Register the individual services of this plugin.
   *
   * @throws Exception\Invalid_Service If a service is not valid.
   */
  public function register_services() {
    // Bail early so we don't instantiate services twice.
    if ( ! empty( $this->services ) ) {
      return;
    }

    $classes = $this->get_service_classes();

    $this->services = array_map(
      [ $this, 'instantiate_service' ],
      $classes
    );

    array_walk(
      $this->services,
      function( Service $service ) {
        $service->register();
      }
    );
  }

  /**
   * Register the assets handler.
   */
  public function register_assets_handler() {
    $this->assets_handler->register();
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
   * Return the instance of the assets handler in use.
   *
   * @return Assets_Handler
   */
  public function get_assets_handler() : Assets_Handler {
    return $this->assets_handler;
  }

  /**
   * Instantiate a single service.
   *
   * @param string $class Service class to instantiate.
   *
   * @return Service
   * @throws Exception\Invalid_Service If the service is not valid.
   */
  private function instantiate_service( $class ) {
    if ( ! class_exists( $class ) ) {
      throw Exception\Invalid_Service::from_service( $class );
    }

    $service = new $class();

    if ( ! $service instanceof Service ) {
      throw Exception\Invalid_Service::from_service( $service );
    }

    if ( $service instanceof Assets_Aware ) {
      $service->with_assets_handler( $this->assets_handler );
    }

    return $service;
  }

  /**
   * Get the list of services to register.
   *
   * A list of classes which contain hooks.
   *
   * @return array<string> Array of fully qualified class names.
   */
  private function get_service_classes() : array {
    return [
      Admin_Menus\Plugin_Options::class,
      Authorization\Operations_Role::class,
      Custom_Post_Type\Example_Post::class,
      Custom_Taxonomy\Example_Taxonomy::class,
      Routes\Register_Rest_Routes::class,
    ];
  }
}
