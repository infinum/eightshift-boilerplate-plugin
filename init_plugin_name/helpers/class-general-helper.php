<?php
/**
 * The general helper specific functionality.
 *
 * @since   1.0.0
 * @package init_plugin_name
 */

namespace Inf_Plugin\Helpers;

/**
 * Class General Helper
 */
class General_Helper {

  /**
   * Global plugin name
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $plugin_name;

  /**
   * Global plugin version
   *
   * @var string
   *
   * @since 1.0.0
   */
  protected $plugin_version;

  /**
   * Initialize class
   *
   * @param array $plugin_info Load global plugin info.
   *
   * @since 1.0.0
   */
  public function __construct( $plugin_info = null ) {
    $this->plugin_name     = $plugin_info['plugin_name'];
    $this->plugin_version  = $plugin_info['plugin_version'];
  }

  /**
   * Return timestamp when file is changes.
   * This is used for cache busting assets.
   *
   * @param string $filename File name you want to get timestamp from.
   * @return init Timestamp.
   *
   * @since 1.0.0
   */
  public function get_assets_version( $filename = null ) {
    if ( ! $filename ) {
      return false;
    }

    $file_location = get_template_directory() . $filename;

    if ( ! file_exists( $file_location ) ) {
      return;
    }

    return filemtime( $file_location );
  }

}
