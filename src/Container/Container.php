<?php
/**
 * Container class.
 * 
 * The `Container` class handles storing objects for later use and 
 * handles single instances to avoid globals or singleton.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Container;
use Backdrop\Contracts\Container as ContainerContract;
use ArrayAccess;
use Closure;
use ReflectionClass;
use ReflectionParameter;
use ReflectionUnionType;

/**
 * A simple container for objects.
 *
 * @since  2.0.0
 * @access public
 */
class Container implements ContainerContract, ArrayAccess {
	/**
	* Stored definitions of objects.
	*
	* @since  2.0.0
	* @access protected
	* @var    array
	*/
	protected $bindings = [];

	/**
	 * Array of aliases for bindings.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @var    array
	 */
	protected $aliases = [];

	/**
	* Array of single instance objects.
	*
	* @since  2.0.0
	* @access protected
	* @var    array
	*/
	protected $instances = [];

	/**
	* Array of object extensions.
	*
	* @since  2.0.0
	* @access protected
	* @var    array
	*/
	protected $extensions = [];

	/**
	* Set up a new container.
	*
	* @since  2.0.0
	* @access public
	* @param  array  $definitions
	* @return void
	*/
	public function __construct( array $definitions = [] ) {
		foreach ( $definitions as $abstract => $concrete ) {
			$this->add( $abstract, $concrete );
		}
	}
    
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
    public function bind( string $abstract, mixed $concrete = null, bool $shared = false ) : void {
		/**
		 * Drop all of the stale instances and aliases
		 * 
		 * @since  2.0.0
		 * @access public
		 * @param  string  $abstract
		 * @return void
		 */
		unset( $this->instances[ $abstract ] );

		/**
		 * If no concrete type was given, we will simply set the concrete type to the
		 * abstract type. After, the concrete type to be registered as shared without
		 * be forced to state their classes in both  of the parameters
		 */
		if ( is_null( $concrete ) ) {
			$concrete = $abstract;
		}

		$this->bindings[ $abstract ]   = compact( 'concrete', 'shared' );

		$this->extensions[ $abstract ] = [];
    }

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
	public function add( string $abstract, mixed $concrete = null, bool $shared = false ) : void {
		if ( ! $this->bound( $abstract ) ) {
			$this->bind( $abstract, $concrete, $shared );
		}
	}

	/**
	 * Remove a binding.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @return void
	 */
	public function remove( string $abstract ) : void {

		if ( $this->bound( $abstract ) ) {

			unset( $this->bindings[ $abstract ], $this->instances[ $abstract ] );
		}
	}

	/**
	 * Resolve and return the binding.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  array   $parameters
	 * @return mixed
	 */
    public function resolve( string $abstract, array $parameters = [] ) : mixed {
		
		// Let's grab the true abstract name.
		$abstract = $this->getAlias( $abstract );

		/**
		 * if an instance of the type is currently being managed as a singleton
		 * we'll just return an existing instance instead of instantiating a new
		 * instance so the developer can keep using the same objects instance
		 * every time.
		 */
		if ( isset( $this->instances[ $abstract ] ) ) {
			return $this->instances[ $abstract ];
		}

		// Get the concrete implementation.
		$concrete = $this->getConcrete( $abstract );

		// If we can't build an object, assume we should return the value.
		if ( ! $this->isBuildable( $concrete ) ) {

			// If we don't actually have this, return false.
			if ( ! $this->bound( $abstract ) ) {
				return false;
			}

			return $concrete;
		}

		// Build the object.
		$object = $this->build( $concrete, $parameters );

		if ( ! $this->bound( $abstract ) ) {
			return $object;
		}

		// If shared instance, make sure to store it in the instances
		// array so that we're not creating new objects later.
		if ( $this->bindings[ $abstract ]['shared'] && ! isset( $this->instances[ $abstract ] ) ) {

			$this->instances[ $abstract ] = $object;
		}

		// Run through each of the extensions for the object.
		foreach ( $this->extensions[ $abstract ] as $extension ) {

			$object = new $extension( $object, $this );
		}

		// Return the object.
		return $object;
	}

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
	public function get( string $abstract ) : mixed {
        return $this->resolve( $abstract );
    }

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
	public function bound( string $abstract ) : bool {

        return isset( $this->bindings[ $abstract ] ) || isset( $this->instances[ $abstract ] );
    }

	/**
	 * Add a shared binding.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  object  $concrete
	 * @return void
	 */
    public function singleton( string $abstract, mixed $concrete = null ) : void {

		$this->add( $abstract, $concrete, true );
	}

	/**
	 * Add an existing instance. This can be an instance of an object or a
	 * single value that should be stored.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  mixed   $instance
	 * @return mixed
	 */
	public function instance( string $abstract, mixed $instance ) : mixed {

		$this->instances[ $abstract ] = $instance;

		return $instance;
	}

	/**
	 * Extend a binding with something like a decorator class. Cannot
	 * extend resolved instancfes.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  Closure $closure
	 * @return void
	 */
	public function extend( string $abstract, Closure $closure ) : void {

		$abstract = $this->getAlias( $abstract );

		$this->extensions[ $abstract ][] = $closure;
	}

	/**
	 * Creates an alias for an abstract type. This allows you to add alias
	 * names that are easier to remember rather than using full class names.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  string  $alias
	 * @return void
	 */
	public function alias( string $abstract, string $alias ) : void {
		$this->aliases[ $alias ] = $abstract;
	}

}