<?php
/**
 * Class Init tests
 *
 * @package WP_Boilerplate_Plugin\Tests
 */

namespace WP_Boilerplate_Plugin\Tests;

use PHPUnit\Framework\TestCase;

use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;

use Brain\Monkey;

abstract class Init_Test_Case extends TestCase {

  // Adds Mockery expectations to the PHPUnit assertions count.
  use MockeryPHPUnitIntegration;

  /**
   * Setup method necessary for Brain Monkey to function
   *
   * @return void
   */
  protected function setUp() {
    parent::setUp();
    Monkey\setUp();
    \WP_Mock::setUp();
  }

  /**
   * Teardown method necessary for Brain Monkey to function
   *
   * @return void
   */
  protected function tearDown() {
    Monkey\tearDown();
    \WP_Mock::tearDown();
    parent::tearDown();
  }
}
