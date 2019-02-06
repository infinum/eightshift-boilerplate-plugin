<?php
/**
 * File that holds taxonomy class for example taxonomy registration
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Custom_Taxonomy
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Custom_Taxonomy;

use WP_Boilerplate_Plugin\Core\Service;
use WP_Boilerplate_Plugin\Custom_Post_Type\Example_Post_Type;
use WP_Boilerplate_Plugin\Custom_Post_Type\Label_Generator;

/**
 * Class Example_Taxonomy.
 *
 * @since 1.0.0
 */
class Example_Taxonomy extends Base_Taxonomy {
  /**
   * The systems custom taxonomy type slug
   *
   * @var string
   */
   const TAXONOMY_SLUG = 'example-taxonomy';

  /**
   * The custom post type type slug
   *
   * @var string
   */
   const POST_TYPE_SLUG = Example_Post_Type::POST_TYPE_SLUG;

  /**
   * Get the slug of the custom taxonomy
   *
   * @return string Custom taxonomy slug.
   */
  protected function get_taxonomy_slug() : string {
    return self::TAXONOMY_SLUG;
  }

  /**
   * Get the post type slug to use the taxonomy to
   *
   * @return string Custom post type slug.
   */
  protected function get_post_type_slug() : string {
    return self::POST_TYPE_SLUG;
  }

  /**
   * Get the arguments that configure the custom taxonomy.
   *
   * @return array Array of arguments.
   */
  protected function get_taxonomy_arguments() : array {
    $nouns = [
      Label_Generator::SINGULAR_NAME_UC => esc_html_x( 'Example category', 'post type upper case singular name', 'wp-boilerplate-plugin' ),
      Label_Generator::SINGULAR_NAME_LC => esc_html_x( 'example category', 'post type lower case singular name', 'wp-boilerplate-plugin' ),
      Label_Generator::PLURAL_NAME_UC   => esc_html_x( 'Example categories', 'post type upper case plural name', 'wp-boilerplate-plugin' ),
      Label_Generator::PLURAL_NAME_LC   => esc_html_x( 'example categories', 'post type lower case plural name', 'wp-boilerplate-plugin' ),
    ];

    return [
      'label'              => $nouns[ Label_Generator::SINGULAR_NAME_UC ],
      'labels'             => ( new Label_Generator() )->get_generated_labels( $nouns ),
      'hierarchical'          => true,
      'show_ui'               => true,
      'show_admin_column'     => true,
      'update_count_callback' => '_update_post_term_count',
      'query_var'             => true,
    ];
  }
}
