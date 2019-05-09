<?php
/**
 * Plugin main file starting point
 *
 * @since             1.0.0
 * @package           WP_Boilerplate_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Infinum WordPress Boilerplate plugin
 * Plugin URI:        https://github.com/infinum/wp-boilerplate-plugin
 * Description:       This is WP Boilerplate Plugin, a modern boilerplate/starter plugin
 * Version:           1.0.0
 * Author:            Infinum <info@infinum.co>
 * Author URI:        https://infinum.co/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-boilerplate-plugin
 * Requires PHP:      7.2
 */

namespace WP_Boilerplate_Plugin;

use WP_Boilerplate_Plugin\Core\Plugin_Factory;

/*
 * Make sure this file is only run from within WordPress.
 */
defined( 'ABSPATH' ) || die();

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 *
 * @since 1.0.0
 */
$autoloader = __DIR__ . '/vendor/autoload.php';

if ( is_readable( $autoloader ) ) {
  require_once $autoloader;
}

/**
 * Plugin URL const
 */
define( 'PLUGIN_BASE_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 *
 * @since 1.0.0
 */
register_activation_hook(
  __FILE__,
  function() {
    Plugin_Factory::create()->activate();
  }
);

/**
 * The code that runs during plugin deactivation.
 *
 * @since 1.0.0
 */
register_deactivation_hook(
  __FILE__,
  function() {
    Plugin_Factory::create()->deactivate();
  }
);

/**
 * Begins plugin execution.
 *
 * @since 1.0.0
 */
Plugin_Factory::create()->register();
