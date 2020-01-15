<?php
/**
 * The file that defines the project entry point class.
 *
 * A class definition that includes attributes and functions used across both the
 * public side of the site and the admin area.
 *
 * @package Eightshift_Boilerplate\Core
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Core;

use Eightshift_Libs\Core\Config as Lib_Config;

/**
 * The project config class.
 *
 * @since 4.0.0
 */
class Config extends Lib_Config {

  /**
   * Method that returns project name.
   *
   * Generally used for naming assets handlers, languages, etc.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_name() : string {
    return 'eightshift-boilerplate';
  }

  /**
   * Method that returns project version.
   *
   * Generally used for versioning asset handlers while enqueueing them.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_version() : string {
    return '1.0.0';
  }

  /**
   * Method that returns project prefix.
   *
   * The WordPress filters live in a global namespace, so we need to prefix them to avoid naming collisions.
   *
   * @return string Full path to asset.
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_prefix() : string {
    return 'eb';
  }

  /**
   * Return project absolute path.
   *
   * If used in a theme use get_template_directory() and in case it's used in a plugin use __DIR__.
   *
   * @param string $path Additional path to add to project path.
   *
   * @return string
   *
   * @since 4.0.0 Added in the project
   */
  public static function get_project_path( string $path = '' ) : string {
    return __DIR__ . '..' .  $path;
  }
}
