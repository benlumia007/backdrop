<?php
/**
 * Application contract.
 *
 * The Application class should be the primary class for working with and
 * launching the app. It extends the `Container` contract.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Contracts\Core;

use Backdrop\Core\ServiceProvider;
use Closure;

interface Application extends Container {

	/**
	 * Add a binding. The abstract should be a key, abstract class name, or
	 * interface name. The concrete should be the concrete implementation of
	 * the abstract.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string $abstract
	 * @param  mixed  $concrete
	 * @param  bool   $shared
	 * @return void
	 */
	public function bind( string $abstract, mixed $concrete = null, bool $shared = false ) : void;

	/**
	 * Alias for `bind()`.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  mixed   $concrete
	 * @param  bool    $shared
	 * @return void
	 */
	public function add( string $abstract, mixed $concrete = null, bool $shared = false ) : void;

	/**
	 * Remove a binding.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @return void
	 */
	public function remove( string $abstract ) : void;

	/**
	 * Resolve and return the binding.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  array   $parameters
	 * @return mixed
	 */
	public function resolve( string $abstract, array $parameters = [] ) : mixed;

	/**
	 * Alias for `resolve()`.
	 *
	 * Follows the PSR-11 standard. Do not alter.
	 * @link https://www.php-fig.org/psr/psr-11/
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @return object
	 */
	public function get( string $abstract ) : mixed;

	/**
	 * Check if a binding exists.
	 *
	 * Follows the PSR-11 standard. Do not alter.
	 * @link https://www.php-fig.org/psr/psr-11/
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @return bool
	 */
	public function bound( string $abstract ) : bool;

	/**
	 * Add a shared binding.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  object  $concrete
	 * @return void
	 */
	public function singleton( string $abstract, mixed $concrete = null ) : void;

	/**
	 * Add an existing instance.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  mixed   $instance
	 * @return mixed
	 */
	public function instance( string $abstract, mixed $instance ) : mixed;

	/**
	 * Extend a binding.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  Closure $closure
	 * @return void
	 */
	public function extend( string $abstract, Closure $closure ) : void;

	/**
	 * Create an alias for an abstract type.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  string  $alias
	 * @return void
	 */
	public function alias( string $abstract, string $alias ) : void;

	/**
	 * Adds a service provider. Developers can pass in an object or a fully-
	 * qualified class name.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  ServiceProvider|string  $provider
	 * @return void
	 */
	public function provider( ServiceProvider|string $provider ): void;

	/**
	 * Adds a static proxy alias. Developers must pass in fully-qualified
	 * class name and alias class name.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $class_name
	 * @param  string  $alias
	 * @return void
	 */
	public function proxy( string $class_name, string $alias ): void;
}
