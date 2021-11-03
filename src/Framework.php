<?php
/**
 * Backdrop Core ( src/Core/Framework.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @author    Benjamin Lu ( https://getbenonit.com )
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop;
use Benlumia007\Backdrop\Container\Container;
use Benlumia007\Backdrop\Contracts\Foundation\Application as FrameworkContract;
use Benlumia007\Backdrop\Contracts\Bootable;
use Benlumia007\Backdrop\Proxies\Proxy;
use Benlumia007\Backdrop\Proxies\App;

/**
 * Application class.
 *
 * @since  3.0.0
 * @access public
 */
class Framework extends Container implements FrameworkContract, Bootable {

	/**
	 * The current version of the framework.
	 *
	 * @since  3.0.0
	 * @access public
	 * @var    string
	 */
	const VERSION = '3.0.0';

	/**
	 * Array of service provider objects.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @var    array
	 */
	protected $providers = [];

	/**
	 * Array of static proxy classes and aliases.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @var    array
	 */
	protected $proxies = [];

	/**
	 * Array of booted service providers.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @var    array
	 */
	protected $booted_providers = [];

	/**
	 * Array of registered proxies.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @var    array
	 */
	protected $registered_proxies = [];

	/**
	 * Registers the default bindings, providers, and proxies for the
	 * framework.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->registerDefaultBindings();
		$this->registerDefaultProxies();
	}

	/**
	 * Calls the functions to register and boot providers and proxies.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot() {
		$this->bootProviders();
		$this->registerProxies();

		if ( ! defined( 'BACKDROP_BOOTED' ) ) {
			define( 'BACKDROP_BOOTED', true );
		}
	}

	/**
	 * Registers the default bindings we need to run the framework.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @return void
	 */
	protected function registerDefaultBindings() {

		// Add the instance of this application.
		$this->instance( 'app', $this );

		// Add the version for the framework.
		$this->instance( 'version', static::VERSION );
	}

	/**
	 * Adds the default static proxy classes.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @return void
	 */
	protected function registerDefaultProxies() {
		$this->proxy( App::class, 'Benlumia007\Backdrop\App' );
	}

	/**
	 * Adds a service provider.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string|object  $provider
	 * @return void
	 */
	public function provider( $provider ) {

		/**
		 * Creates a new instance of a service provider class.
		 */
		if ( is_string( $provider ) ) {
			$provider = new $provider( $this );
		}

		/**
		 * Call a service provider's `register()` method if exists.
		 */
		if ( method_exists( $provider, 'register' ) ) {
			$provider->register();
		}

		$this->providers[] = $provider;
	}

	/**
	 * Calls the `boot()` method of all the registered service providers.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @return void
	 */
	protected function bootProviders() {

		foreach ( $this->providers as $provider ) {
			$class_name = get_class( $provider );

			if ( in_array( $class_name, $this->booted_providers ) ) {
				return;
			}

			/**
			 * Calls a service provider's `boot()` if it exists.
			 */
			if ( method_exists( $provider, 'boot' ) ) {
				$provider->boot();
				$this->booted_providers[] = $class_name;
			}
		}
	}

	/**
	 * Adds a static proxy alias. Developers must pass in fully-qualified
	 * class name and alias class name.
	 *
	 * @since  3.0.0
	 * @access public
	 * @param  string  $class_name
	 * @param  string  $alias
	 * @return void
	 */
	public function proxy( $class_name, $alias ) {

		$this->proxies[ $class_name ] = $alias;
	}

	/**
	 * Registers the static proxy classes.
	 *
	 * @since  3.0.0
	 * @access protected
	 * @return void
	 */
	protected function registerProxies() {

		if ( ! $this->registered_proxies ) {
			Proxy::setContainer( $this );
		}

		foreach ( $this->proxies as $class => $alias ) {
			// Register proxy if not already registered.
			if ( ! in_array( $alias, $this->registered_proxies ) ) {
				if ( ! class_exists( $alias ) ) {
					class_alias( $class, $alias );
				}

				$this->registered_proxies[] = $alias;
			}
		}
	}
}