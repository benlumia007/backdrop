<?php
/**
 * Application contract.
 *
 * The Application class should be the be the primary class for working with and
 * launching the app. It extends the `Container` contract.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright Copyright (C) 2019-2022. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop-container
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Container\Contracts;

use Backdrop\Contracts\Container;
use Backdrop\Core\ServiceProvider;

interface Application extends Container {

    /**
	 * Adds a service provider. Developers can pass in an object or a fully-
	 * qualified class name.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string|object  $provider
	 * @return void
	 */
    public function provider( ServiceProvider|string $provider ) : void;

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
    public function proxy( string $class_name, string $alias ) : void;
}
