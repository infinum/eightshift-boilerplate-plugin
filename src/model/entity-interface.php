<?php
/**
 * Interface for creating object entities
 *
 * The interface presents a contract that will be implemented by abstract classes used for retrieving the database data.
 *
 * Entities will be used for fetching (custom) post, term, user and options data.
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Model
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Model;

/**
 * Interface Entity.
 */
interface Entity {

  /**
   * Return the entity ID.
   *
   * @return int Entity ID.
   */
  public function get_id() : int;
}
