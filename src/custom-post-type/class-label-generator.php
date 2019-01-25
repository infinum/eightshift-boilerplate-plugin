<?php
/**
 * File containing label generator class
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Custom_Post_Type
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Custom_Post_Type;

use WP_Boilerplate_Plugin\Exception\Invalid_Nouns;

/**
 * Class that generates lables for custom post type
 *
 * @since 1.0.0
 */
final class Label_Generator {

  const SINGULAR_NAME_UC = 'singular_name_uc';
  const SINGULAR_NAME_LC = 'singular_name_lc';
  const PLURAL_NAME_UC   = 'plural_name_uc';
  const PLURAL_NAME_LC   = 'plural_name_lc';

  const REQUIRED_NOUNS = [
    self::SINGULAR_NAME_UC,
    self::SINGULAR_NAME_LC,
    self::PLURAL_NAME_UC,
    self::PLURAL_NAME_LC,
  ];

  /**
   * Get automatically generated labels from a singular and an optional
   * plural noun.
   *
   * @param array $nouns Array of nouns to use for the labels.
   *
   * @return string[] array Array of labels.
   * @throws Invalid_Nouns Invalid nouns exception.
   */
  public function get_generated_labels( array $nouns ) : array {

    foreach ( self::REQUIRED_NOUNS as $noun_key ) {
      if ( ! array_key_exists( $noun_key, $nouns ) ) {
        throw Invalid_Nouns::from_key( $noun_key );
      }
    }

    $label_templates = [
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'name'                  => esc_html_x( '%3$s', 'Post Type General Name', 'wp-boilerplate-plugin' ), /* phpcs:disable */
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'singular_name'         => esc_html_x( '%1$s', 'Post Type Singular Name', 'wp-boilerplate-plugin' ), /* phpcs:disable */
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'menu_name'             => esc_html__( '%3$s', 'wp-boilerplate-plugin' ), /* phpcs:disable */
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'name_admin_bar'        => esc_html__( '%1$s', 'wp-boilerplate-plugin' ), /* phpcs:disable */
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'archives'              => esc_html__( '%1$s Archives', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'attributes'            => esc_html__( '%1$s Attributes', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'parent_item_colon'     => esc_html__( 'Parent %1$s:', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'all_items'             => esc_html__( 'All %3$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'add_new_item'          => esc_html__( 'Add New %1$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'add_new'               => esc_html__( 'Add New', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'new_item'              => esc_html__( 'New %1$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'edit_item'             => esc_html__( 'Edit %1$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'update_item'           => esc_html__( 'Update %1$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'view_item'             => esc_html__( 'View %1$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'view_items'            => esc_html__( 'View %3$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'search_items'          => esc_html__( 'Search %1$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'not_found'             => esc_html__( 'Not found', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'featured_image'        => esc_html__( 'Featured Image', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'set_featured_image'    => esc_html__( 'Set featured image', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'remove_featured_image' => esc_html__( 'Remove featured image', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'use_featured_image'    => esc_html__( 'Use as featured image', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'insert_into_item'      => esc_html__( 'Insert into %2$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'uploaded_to_this_item' => esc_html__( 'Uploaded to this %2$s', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'items_list'            => esc_html__( '%3$s list', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'items_list_navigation' => esc_html__( '%3$s list navigation', 'wp-boilerplate-plugin' ),
      /* Translators: %1$s uc singular, %2$s lc singular, %3$s uc plural, %4$s lc plural. */
      'filter_items_list'     => esc_html__( 'Filter %4$s list', 'wp-boilerplate-plugin' ),
    ];

    return array_map(
      function( $label ) use ( $nouns ) {
        return sprintf(
          $label,
          $nouns[ self::SINGULAR_NAME_UC ],
          $nouns[ self::SINGULAR_NAME_LC ],
          $nouns[ self::PLURAL_NAME_UC ],
          $nouns[ self::PLURAL_NAME_LC ]
        );
      },
      $label_templates
    );
  }
}
