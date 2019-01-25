<?php
/**
 * Post object entity abstract class file
 *
 * This file is used as a blueprint to extend other (custom) posts.
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Model
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Model;

use WP_Post;

/**
 * Abstract class Post_Object_Entity.
 *
 * Whenever any post, page, menu (etc.) data needs to be
 * stored in the database, we extend this class.
 */
abstract class Post_Object_Entity implements Entity {

  /**
   * WordPress post data representing the post.
   *
   * @var WP_Post
   */
  protected $post;

  /**
   * Instantiate a Post_Object_Entity object.
   *
   * @param WP_Post $post Post object to instantiate a Post_Object_Entity model from.
   */
  public function __construct( WP_Post $post ) {
    $this->post = $post;
  }

  /**
   * Return the entity ID.
   *
   * @return int Entity ID.
   */
  public function get_id() : int {
    return $this->post->ID;
  }

  /**
   * Return the WP_Post object that represents this model.
   *
   * @return WP_Post WP_Post object representing this model.
   */
  public function get_post_object() : WP_Post {
    return $this->post;
  }

  /**
   * Get the post's title.
   *
   * @return string Title of the post.
   */
  public function get_title() : string {
    return $this->post->post_title;
  }

  /**
   * Set the post's title.
   *
   * @param string $title New title of the post.
   */
  public function set_title( string $title ) {
    $this->post->post_title = $title;
  }

  /**
   * Get the post's content.
   *
   * @return string Content of the post.
   */
  public function get_content() : string {
    return $this->post->post_content;
  }

  /**
   * Set the post's content.
   *
   * @param string $content New content of the post.
   */
  public function set_content( string $content ) {
    $this->post->post_content = $content;
  }

  /**
   * Get the post type of the post.
   *
   * @return string the post type of the post.
   */
  public function get_post_type() : string {
    return $this->post->post_type;
  }

  /**
   * Set the post's post type.
   *
   * @param string $post_type New post_type of the post.
   */
  public function set_post_type( string $post_type ) {
    $this->post->post_type = $post_type;
  }

  /**
   * Magic getter method to fetch meta properties only when requested.
   *
   * @param string $property Property that was requested.
   *
   * @return mixed
   */
  public function __get( string $property ) : string {
    if ( array_key_exists( $property, $this->get_lazy_properties() ) ) {
      $this->load_lazy_property( $property );

      return $this->$property;
    }

    $message = sprintf(
      'Undefined property: %s::$%s',
      static::class,
      $property
    );

    trigger_error( $message, E_USER_NOTICE ); // phpcs:ignore

    return null;
  }

  /**
   * Persist the additional properties of the entity.
   *
   * @return void
   */
  abstract public function persist_properties() : void;

  /**
   * Return the list of lazily-loaded properties and their default values.
   *
   * @return array
   */
  abstract protected function get_lazy_properties() : array;

  /**
   * Load a lazily-loaded property.
   *
   * After this process, the loaded property should be set within the
   * object's state, otherwise the load procedure might be triggered multiple
   * times.
   *
   * @param string $property Name of the property to load.
   *
   * @return void
   */
  abstract protected function load_lazy_property( string $property ) : void;
}
