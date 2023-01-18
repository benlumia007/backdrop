<?php
/**
 * Object templates service provider.
 *
 * This is the service provider for the object templates system, which binds an
 * empty collection to the container that can later be used to register templates.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-template-manager
 */

namespace Backdrop\Template\Manager;

use Backdrop\Tools\ServiceProvider;
use ReflectionException;

/**
 * Object templates provider class.
 *
 * @since  1.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Registers the templates collection and manager.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function register(): void {

		$this->app->singleton( Component::class );
	}

	/**
	 * Boots the manager by firing its hooks in the `boot()` method.
	 *
	 * @return void
	 * @throws ReflectionException
	 * @since  1.0.0
	 * @access public
	 */
	public function boot() : void {

		$this->app->resolve( Component::class )->boot();
	}
}
