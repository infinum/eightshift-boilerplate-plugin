<?php
/**
 * View file for the plugin options page
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin
 */

namespace WP_Boilerplate_Plugin;

?>
<h3><?php esc_html_e( 'Plugin options', 'wp-boilerplate-plugin' ); ?></h3>
<div class="info"><?php esc_html_e( 'These are some plugin options. Put some settings in...', 'wp-boilerplate-plugin' ); ?></div>
<?php
echo $this->nonce_field; // phpcs:ignore
