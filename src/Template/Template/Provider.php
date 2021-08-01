<?php
/**
 * Object templates service provider.
 *
 * This is the service provider for the object templates system, which binds an
 * empty collection to the container that can later be used to register templates.
 *
 * @package   HybridCore
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2019, Justin Tadlock
 * @link      https://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Benlumia007\Backdrop\Template\Template;
use Benlumia007\Backdrop\Template\Template\Component;
use Benlumia007\Backdrop\Tools\ServiceProvider;

/**
 * Object templates provider class.
 *
 * @since  2.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Registers the templates collection and manager.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		$this->app->singleton( Component::class );

		$this->app->alias( Component::class, 'template/manager' );
	}

	/**
	 * Boots the manager by firing its hooks in the `boot()` method.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		$this->app->resolve( 'template/manager' )->boot();
	}
}