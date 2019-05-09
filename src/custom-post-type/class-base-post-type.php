<?php
/**
 * File that holds base abstract class for custom post type registration
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Custom_Post_Type
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Custom_Post_Type;

use WP_Boilerplate_Plugin\Custom_Fields\Custom_Field;
use WP_Boilerplate_Plugin\Core\Service;

/**
 * Abstract class Base_Post_Type.
 *
 * @since 1.0.0
 */
abstract class Base_Post_Type implements Service {

  /**
   * Register custom post type and taxonomy.
   */
  public function register() : void {
    add_action(
      'init',
      function() {
        register_post_type( $this->get_post_type_slug(), $this->get_post_type_arguments() );

        foreach ( $this->get_custom_rest_fields() as $custom_rest_field ) {
          $custom_rest_field->register();
        }

        foreach ( $this->get_custom_fields() as $custom_field ) {
          $custom_field->register();
        }
      }
    );
  }

  /**
   * Get the slug to use for the custom post type.
   *
   * @return string Custom post type slug.
   */
  abstract protected function get_post_type_slug() : string;

  /**
   * Get the arguments that configure the custom post type.
   *
   * @return array Array of arguments.
   */
  abstract protected function get_post_type_arguments() : array;

  /**
   * Get the custom rest API fields to add to a response.
   *
   * @return array Array of custom field schema.
   */
  abstract protected function get_custom_rest_fields() : array;

  /**
   * Get the custom admin fields for the post type.
   *
   * @return array Array of custom field schema.
   */
  protected function get_custom_fields() : array {
    return [];
  }
}
