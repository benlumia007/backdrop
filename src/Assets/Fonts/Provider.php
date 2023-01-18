<?php
/**
 * Fonts provider.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-fonts
 */

namespace Backdrop\Assets\Fonts;

use Backdrop\Tools\ServiceProvider;
use ReflectionException;

class Provider extends ServiceProvider {
	/**
	 * Binds the implementation of the attributes contract to the container.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function register(): void {

		$this->app->bind( Component::class );

		$this->app->alias( Component::class, 'backdrop/fonts' );
	}

	/**
	 * @since  2.0.0
	 * @access public
	 * @throws ReflectionException
	 * @return void;
	 */
	public function boot() : void {
		$this->app->resolve( 'backdrop/fonts' )->boot();
	}
}
