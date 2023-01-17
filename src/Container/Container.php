<?php
/**
 * Container class.
 *
 * The `Container` class handles storing objects for later use and
 * handles single instances to avoid globals or singleton.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Container;

use ArrayAccess;
use Closure;
use ReflectionClass;
use ReflectionException;

/**
 * A simple container for objects.
 *
 * @since  2.0.0
 * @access public
 */
class Container implements ArrayAccess {

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
	 * the abstract. If no concrete is given, its assumed the abstract
	 * handles the concrete implementation.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  mixed   $concrete
	 * @param  bool    $shared
	 * @return void
	 */
	public function bind( string $abstract, $concrete = null, bool $shared = false ): void {

		unset( $this->instances[ $abstract ] );

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
	public function add( string $abstract, $concrete = null, bool $shared = false ): void {

		$this->bind( $abstract, $concrete, $shared );
	}

	/**
	 * Remove a binding.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @return void
	 */
	public function remove( string $abstract ): void {

		if ( $this->has( $abstract ) ) {

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
	public function resolve( string $abstract, array $parameters = [] ) {

		// Get the true abstract name.
		$abstract = $this->getAbstract( $abstract );

		// If this is being managed as an instance and we already have
		// the instance, return it now.
		if ( isset( $this->instances[ $abstract ] ) ) {

			return $this->instances[ $abstract ];
		}

		// Get the concrete implementation.
		$concrete = $this->getConcrete( $abstract );

		// If we can't build an object, assume we should return the value.
		if ( ! $this->isBuildable( $concrete ) ) {

			// If we don't actually have this, return false.
			if ( ! $this->has( $abstract ) ) {
				return false;
			}

			return $concrete;
		}

		// Build the object.
		$object = $this->build( $concrete, $parameters );

		if ( ! $this->has( $abstract ) ) {
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
	 * Creates an alias for an abstract. This allows you to add names that
	 * are easy to access without remembering more complex class names.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  string  $alias
	 * @return void
	 */
	public function alias( string $abstract, string $alias ): void {

		$this->aliases[ $alias ] = $abstract;
	}

	/**
	 * Alias for `resolve()`.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @return object
	 */
	public function get( string $abstract ) {

		return $this->resolve( $abstract );
	}

	/**
	 * Check if a binding exists.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @return bool
	 */
	public function has( string $abstract ): bool {

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
	public function singleton( string $abstract, $concrete = null ): void {

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
	public function instance( string $abstract, $instance ) {

		$this->instances[ $abstract ] = $instance;

		return $instance;
	}

	/**
	 * Extend a binding with something like a decorator class. Cannot
	 * extend resolved instances.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $abstract
	 * @param  Closure $closure
	 * @return void
	 */
	public function extend( string $abstract, Closure $closure ): void {

		$abstract = $this->getAbstract( $abstract );

		$this->extensions[ $abstract ][] = $closure;
	}

	/**
	 * Checks if we're dealing with an alias and returns the abstract. If
	 * not an alias, return the abstract passed in.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @param  string    $abstract
	 * @return string
	 */
	protected function getAbstract( string $abstract ): string {

		if ( isset( $this->aliases[ $abstract ] ) ) {
			return $this->aliases[ $abstract ];
		}

		return $abstract;
	}

	/**
	 * Gets the concrete of an abstract.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @param  string    $abstract
	 * @return mixed
	 */
	protected function getConcrete( string $abstract ) {

		$concrete = false;
		$abstract = $this->getAbstract( $abstract );

		if ( $this->has( $abstract ) ) {
			$concrete = $this->bindings[ $abstract ]['concrete'];
		}

		return $concrete ?: $abstract;
	}

	/**
	 * Determines if a concrete is buildable. It should either be a closure
	 * or a concrete class.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @param  mixed    $concrete
	 * @return bool
	 */
	protected function isBuildable( $concrete ): bool {

		return $concrete instanceof Closure
			|| ( is_string( $concrete ) && class_exists( $concrete ) );
	}

	/**
	 * Builds the concrete implementation. If a closure, we'll simply return
	 * the closure and pass the included parameters. Otherwise, we'll resolve
	 * the dependencies for the class and return a new object.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @param  mixed  $concrete
	 * @param  array  $parameters
	 * @throws ReflectionException
	 * @return object
	 */
	protected function build( $concrete, array $parameters = [] ) {

		if ( $concrete instanceof Closure ) {
			return $concrete( $this, $parameters );
		}

		$reflect = new ReflectionClass( $concrete );

		$constructor = $reflect->getConstructor();

		if ( ! $constructor ) {
			return new $concrete();
		}

		return $reflect->newInstanceArgs(
			$this->resolveDependencies( $constructor->getParameters(), $parameters )
		);
	}

	/**
	 * Resolves the dependencies for a method's parameters.
	 *
	 * @todo Handle errors when we can't solve a dependency.
	 *
	 * @since  2.0.0
	 * @access protected
	 * @param  array     $dependencies
	 * @param  array     $parameters
	 * @return array
	 */
	protected function resolveDependencies( array $dependencies, array $parameters ): array {

		$args = [];

		foreach ( $dependencies as $dependency ) {

			// If a dependency is set via the parameters passed in, use it.
			if ( isset( $parameters[ $dependency->getName() ] ) ) {

				$args[] = $parameters[ $dependency->getName() ];

				// If the parameter is a class, resolve it.
			} elseif ( ! is_null( $dependency->getClass() ) ) {

				$args[] = $this->resolve( $dependency->getClass()->getName() );

				// Else, use the default parameter value.
			} elseif ( $dependency->isDefaultValueAvailable() ) {

				$args[] = $dependency->getDefaultValue();
			}
		}

		return $args;
	}

	/**
	 * Sets a property via `ArrayAccess`.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $offset
	 * @param  mixed   $value
	 * @return void
	 */
	public function offsetSet( $offset, $value ) {

		$this->add( $offset, $value );
	}

	/**
	 * Unsets a property via `ArrayAccess`.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $offset
	 * @return void
	 */
	public function offsetUnset( $offset ) {

		$this->remove( $offset );
	}

	/**
	 * Checks if a property exists via `ArrayAccess`.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $offset
	 * @return bool
	 */
	public function offsetExists( $offset ): bool {

		return $this->has( $offset );
	}

	/**
	 * Returns a property via `ArrayAccess`.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $offset
	 * @return false|object|string
	 */
	public function offsetGet( $offset ) {

		return $this->get( $offset );
	}


	/**
	 * Magic method when trying to set a property.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $value
	 * @return void
	 */
	public function __set( string $name, $value ) {

		$this->add( $name, $value );
	}

	/**
	 * Magic method when trying to unset a property.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return void
	 */
	public function __unset( string $name ) {

		$this->remove( $name );
	}

	/**
	 * Magic method when trying to check if a property exists.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return bool
	 */
	public function __isset( string $name ) {

		return $this->has( $name );
	}

	/**
	 * Magic method when trying to get a property.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return false|object|string
	 */
	public function __get( string $name ) {

		return $this->get( $name );
	}
}
