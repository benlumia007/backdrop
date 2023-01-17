<?php
/**
 * FontAwesome provider.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop/fontawesome
 */

/**
 * Define namespace
 */
namespace Backdrop\Assets\FontAwesome;

use Backdrop\Tools\ServiceProvider;

/**
 * FontAwesome provider.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Binds the implementation of the attributes contract to the container.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register(): void {

		$this->app->bind( Component::class );

		$this->app->alias( Component::class, 'backdrop/fontawesome' );
	}

	public function boot() : void {
		$this->app->resolve( 'backdrop/fontawesome' )->boot();
	}
}
