<?php
/**
 * The theme-specific functionality of the plugin.
 *
 * @since   1.0.0
 * @package init_plugin_name
 */

namespace Inf_Plugin\Theme;

use Inf_Plugin\Helpers as General_Helpers;

/**
 * Class Theme
 */
class Theme {

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
   * General Helper class
   *
   * @var object General_Helper
   *
   * @since 1.0.0
   */
  public $general_helper;

  /**
   * Initialize class
   *
   * @param array $plugin_info Load global plugin info.
   *
   * @since 1.0.0
   */
  public function __construct( $plugin_info = null ) {
    $this->plugin_name    = $plugin_info['plugin_name'];
    $this->plugin_version = $plugin_info['plugin_version'];

    $this->general_helper = new General_Helpers\General_Helper();
  }

  /**
   * Register the Stylesheets for the admin area.
   *
   * @since 1.0.0
   */
  public function enqueue_styles() {

    $main_style = 'skin/public/theme/styles/application.css';
    wp_register_style( $this->plugin_name . '-style', plugin_dir_url( __DIR__ ) . $main_style, array(), $this->general_helper->get_assets_version( $main_style ) );
    wp_enqueue_style( $this->plugin_name . '-style' );

  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since 1.0.0
   */
  public function enqueue_scripts() {

    $main_script = 'skin/public/theme/scripts/application.js';
    wp_register_script( $this->plugin_name . '-scripts', plugin_dir_url( __DIR__ ) . $main_script, array(), $this->general_helper->get_assets_version( $main_script ) );
    wp_enqueue_script( $this->plugin_name . '-scripts' );

  }
}
