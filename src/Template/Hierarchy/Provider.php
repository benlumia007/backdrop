<?php
/**
 * Template hierarchy service provider.
 *
 * This is the service provider for the template hierarchy. It's used to register
 * the template hierarchy with the container and boot it when needed.
 *
 * @package   Benlumia007\BackdropCore
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2019, Justin Tadlock
 * @link      https://themeBenlumia007\Backdrop.com/Benlumia007\Backdrop-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Benlumia007\Backdrop\Template\Hierarchy;

use Benlumia007\Backdrop\Contracts\Template\Hierarchy as TemplateHierarchy;
use Benlumia007\Backdrop\Tools\ServiceProvider;

/**
 * Template hierarchy provider class.
 *
 * @since  5.0.0
 * @access public
 */
class Provider extends ServiceProvider {

	/**
	 * Registration callback that adds a single instance of the template
	 * hierarchy to the container.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return void
	 */
	public function register() {

		$this->app->singleton( TemplateHierarchy::class, Component::class );

		$this->app->alias( TemplateHierarchy::class, 'template/hierarchy' );
	}

	/**
	 * Boots the hierarchy by firing its hooks in the `boot()` method.
	 *
	 * @since  5.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {

		$this->app->resolve( 'template/hierarchy' )->boot();
	}
}