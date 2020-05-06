<?php
/**
 * The file that defines the main start class.
 *
 * A class definition that includes attributes and functions used across both the
 * theme-facing side of the site and the admin area.
 *
 * @since   1.0.0
 * @package Eightshift_Boilerplate\Core
 */

declare( strict_types=1 );

namespace Eightshift_Boilerplate\Core;

use Eightshift_Libs\Core\Main as Lib_Core;
use Eightshift_Libs\Manifest as Lib_Manifest;
use Eightshift_Libs\Enqueue as Lib_Enqueue;
use Eightshift_Libs\I18n as Lib_I18n;
use Eightshift_Libs\Blocks as Lib_Blocks;

/**
 * The main start class.
 *
 * This is used to define admin-specific hooks, and
 * theme-facing site hooks.
 *
 * Also maintains the unique identifier of this theme as well as the current
 * version of the theme.
 *
 * @since 1.0.0
 */
class Main extends Lib_Core {

  /**
   * Default main action hook that start the whole lib. If you are using this lib in a plugin please change it to plugins_loaded.
   *
   * @since 2.0.0
   */
  public function get_default_register_action_hook() : string {
    return 'plugins_loaded';
  }

  /**
   * Get the list of services to register.
   *
   * A list of classes which contain hooks.
   *
   * @return array<string> Array of fully qualified class names.
   *
   * @since 1.0.0
   */
  protected function get_service_classes() : array {
    return [

      // Config.
      Config::class,

      // Manifest.
      Lib_Manifest\Manifest::class => [ Config::class ],

      // I18n.
      Lib_I18n\I18n::class => [ Config::class ],

      // Enqueue.
      Lib_Enqueue\Enqueue_Admin::class => [ Lib_Manifest\Manifest::class ],
      Lib_Enqueue\Enqueue_Theme::class => [ Lib_Manifest\Manifest::class ],
      Lib_Enqueue\Enqueue_Blocks::class => [ Lib_Manifest\Manifest::class ],

      // Blocks.
      Lib_Blocks\Blocks::class => [ Config::class ],
    ];
  }
}
