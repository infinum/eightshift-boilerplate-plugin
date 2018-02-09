<?php
/**
 * Plugin main file starting point
 *
 * @since             1.0.0
 * @package           init_plugin_name
 *
 * @wordpress-plugin
 * Plugin Name:       init_plugin_real_name
 * Plugin URI:
 * Description:       init_description
 * Version:           1.0.0
 * Author:            init_author_name
 * Author URI:
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       init_plugin_name
 */

namespace Inf_Plugin;

use Inf_Plugin\Includes as Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/**
 * Plugins version global
 *
 * @since 1.0.0
 * @package init_plugin_name
 */
define( 'INF_PLUGIN_VERSION', '1.0.0' );

/**
 * Plugins name global
 *
 * @since 1.0.0
 * @package init_plugin_name
 */
define( 'INF_PLUGIN_NAME', 'init_plugin_name' );

/**
 * Include the autoloader so we can dynamically include the rest of the classes.
 *
 * @since 1.0.0
 * @package init_plugin_name
 */
include_once( 'lib/autoloader.php' );

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-deactivator.php
 *
 * @since 1.0.0
 */
function deactivate() {
  Includes\Deactivator::deactivate();
}

register_deactivation_hook( __FILE__, __NAMESPACE__ . '\\deactivate' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function init_plugin() {
  $plugin = new Includes\Main();
  $plugin->run();
}

init_plugin();
