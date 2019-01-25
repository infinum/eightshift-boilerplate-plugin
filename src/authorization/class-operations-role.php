<?php
/**
 * File that holds Operations role class
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Authorization
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Authorization;

use \WP_Role;

/**
 * Operations role class
 *
 * This class will change the Administrator role name to Operations.
 */
final class Operations_Role implements Roles {
  const ADMIN_NAME              = 'administrator';
  const ADMIN_DISPLAY_NAME      = 'Administrator';
  const OPERATIONS_DISPLAY_NAME = 'Operations';

  /**
   * Register the current Registerable.
   *
   * @return void
   */
  public function register() : void {
    // Nothing to do here, we're after the (de)activation hook.
  }

  /**
   * Activate the service.
   *
   * @return void
   */
  public function activate() : void {
    $role = get_role( self::ADMIN_NAME );

    if ( ! $role instanceof WP_Role ) {
      return;
    }

    // Temporary store new role so that we can override the name only.
    $new_role = $role;

    $new_role->name = self::OPERATIONS_DISPLAY_NAME;

    remove_role( self::ADMIN_NAME );
    add_role( self::ADMIN_NAME, $new_role->name, $new_role->capabilities );
  }

  /**
   * Dectivate the service.
   *
   * Revert the above changes, to avoid permanent changes.
   *
   * @return void
   */
  public function deactivate() : void {
    $role = get_role( self::ADMIN_NAME );

    if ( ! $role instanceof WP_Role ) {
      return;
    }

    $new_role = $role;

    $new_role->name = self::ADMIN_DISPLAY_NAME;

    remove_role( self::ADMIN_NAME );
    add_role( self::ADMIN_NAME, $new_role->name, $new_role->capabilities );
  }
}
