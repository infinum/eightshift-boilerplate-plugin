<?php
/**
 * File that holds Roles interface
 *
 * @since 1.0.0
 * @package WP_Boilerplate_Plugin\Authorization
 */

declare( strict_types=1 );

namespace WP_Boilerplate_Plugin\Authorization;

use WP_Boilerplate_Plugin\Core\Service;
use WP_Boilerplate_Plugin\Core\Has_Activation;
use WP_Boilerplate_Plugin\Core\Has_Deactivation;

/**
 * Interface Roles.
 *
 * Interface for managing custom user roles.
 *
 * @since 1.0.0
 */
interface Roles extends Service, Has_Activation, Has_Deactivation {

}
