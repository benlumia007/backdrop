<?php
/**
 * Engine class.
 *
 * A wrapper around the `View` class with methods for quickly working with views
 * without having to manually instantiate a view object.  It's also useful
 * because it passes an `$engine` variable to all views.
 *
 * @package   HybridCore
 * @author    Justin Tadlock <justintadlock@gmail.com>
 * @copyright Copyright (c) 2008 - 2019, Justin Tadlock
 * @link      https://themehybrid.com/hybrid-core
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

namespace Benlumia007\Backdrop\View\Engine;
use Benlumia007\Backdrop\Proxies\App;
use Benlumia007\Backdrop\View\View\Component as View;

/**
 * Engine class.
 *
 * @since  5.1.0
 * @access public
 */
class Component {

	/**
	 * Returns a View object.
	 *
	 * @since  5.1.0
	 * @access public
	 * @param  string            $name
	 * @param  array|string      $slugs
	 * @param  array|Collection  $data
	 * @return View
	 */
	public function view( $name, $slugs = [] ) {

		return App::resolve( View::class, compact( 'name', 'slugs' ) );
	}

	/**
	 * Outputs a view template.
	 *
	 * @since  5.1.0
	 * @access public
	 * @param  string            $name
	 * @param  array|string      $slugs
	 * @param  array|Collection  $data
	 * @return void
	 */
	public function display( $name, $slugs = [] ) {

		$this->view( $name, $slugs, $data )->display();
	}

	/**
	 * Returns a view template as a string.
	 *
	 * @since  5.1.0
	 * @access public
	 * @param  string            $name
	 * @param  array|string      $slugs
	 * @param  array|Collection  $data
	 * @return string
	 */
	public function render( $name, $slugs = [] ) {

		return $this->view( $name, $slugs, $data )->render();
	}
}