<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @since 1.0.0
 *
 * @package WP_Boilerplate_Plugin
 */

if ( ! current_user_can( 'activate_plugins' ) ) {
  return;
}

// If uninstall is not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
  exit;
}
