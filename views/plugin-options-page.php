<?php
/**
 * View file for the plugin options page
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin
 */

namespace WP_Boilerplate_Plugin;

use WP_Boilerplate_Plugin\Authorization\Operations_Role;

$user = wp_get_current_user();

$allowed_roles = [
  Operations_Role::ADMIN_NAME,
];

if ( empty( array_intersect( (array) $user->roles, $allowed_roles ) ) ) {
  return false;
}

?>
<h3><?php esc_html_e( 'Plugin options', 'wp-boilerplate-plugin' ); ?></h3>
<div class="info"><?php esc_html_e( 'These are some plugin options. Put some settings in...', 'wp-boilerplate-plugin' ); ?></div>
<?php
echo $this->nonce_field; // phpcs:ignore
