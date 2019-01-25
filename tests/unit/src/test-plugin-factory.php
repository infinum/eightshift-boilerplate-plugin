<?php
/**
 * Class Plugin tests
 *
 * @package WP_Boilerplate_Plugin\Tests\Unit\Src
 */

use Brain\Monkey\Actions;
use Brain\Monkey\Functions;

use WP_Boilerplate_Plugin\Tests\Init_Test_Case;

use WP_Boilerplate_Plugin\Core\Plugin_Factory;
use WP_Boilerplate_Plugin\Core\Plugin;

/**
 * Class that tests the Main plugin functionality.
 */
class Plugin_Factory_Test extends Init_Test_Case {

  /**
   * Test suite setUp method
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Test suite tearDown method
   */
  public function tearDown() {
    \Mockery::close();
    parent::tearDown();
  }

  /**
   * Method that tests the activate() method that runs when plugin is activated
   */
  public function test_plugin_activate() {
    Functions\expect( 'flush_rewrite_rules' )
      ->once()
      ->andReturn( true );

    Plugin_Factory::create()->activate();
  }

  /**
   * Method that tests the deactivate() method that runs when plugin is deactivated
   */
  public function test_plugin_deactivate() {
    Functions\expect( 'flush_rewrite_rules' )
      ->once()
      ->andReturn( true );

    Plugin_Factory::create()->deactivate();
  }

  /**
   * Method that tests the get_assets_handler() method
   */
  public function test_get_assets_handler() {
    $asset_handler = Plugin_Factory::create()->get_assets_handler();

    self::assertTrue( \gettype( $asset_handler ) === 'object' );
    self::assertTrue( \get_class( $asset_handler ) === 'WP_Boilerplate_Plugin\Assets\Assets_Handler' );
  }

  /**
   * Method that tests the register_services() method that registeres services
   */
  public function test_register_services() {
    $services = Plugin_Factory::create()->register_services();

    self::assertNull( $services );
  }

  /**
   * Method that tests the register_assets_handler() method that registeres assets handlers
   *
   * Usecase: no services present - should throw error.
   */
  public function test_register_assets_handler() {
    $assets = Plugin_Factory::create()->register_assets_handler();

    self::assertNull( $assets );
  }

  /**
   * Test plugin when there are no services
   */
  public function test_missing_services() {
    $plugin_mock = \Mockery::mock( new Plugin ); // Proxied partial test double, since the Plugin class is final.
    $plugin_mock
      ->shouldReceive( 'register_services' )
      ->andReturn( 'Service' );

    $services = Plugin_Factory::create()->register_services();
  }

  // To test: mock plugin without services and see if errors are thrown!
}
