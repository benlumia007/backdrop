<?php
/**
 * Container contract.
 *
 * Container classes should be used for storing, retrieving, and resolving
 * classes/objects passed into them.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright (C) 2019-2022. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop-container
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Contracts;
use Closure;

/**
 * Container interface
 *
 * @since  2.0.0
 * @access public
 */
interface Container {

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
	public function has( string $abstract ) : bool;

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
}