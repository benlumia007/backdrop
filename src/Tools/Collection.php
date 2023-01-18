<?php
/**
 * Collection class.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop-tools
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Tools;

use ArrayObject;

/**
 * Registry class.
 *
 * @since  2.0.0
 * @access public
 */
class Collection extends ArrayObject {

	/**
	 * Add an item.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $value
	 * @return void
	 */
	public function add( string $name, $value ): void {

		$this->offsetSet( $name, $value );
	}

	/**
	 * Removes an item.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return void
	 */
	public function remove( string $name ): void {

		$this->offsetUnset( $name );
	}

	/**
	 * Checks if an item exists.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return bool
	 */
	public function has( string $name ): bool {

		return $this->offsetExists( $name );
	}

	/**
	 * Returns an item.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public function get( string $name ): mixed {

		return $this->offsetGet( $name );
	}

	/**
	 * Returns the collection of items.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	public function all(): array {

		return $this->getArrayCopy();
	}

	/**
	 * Magic method when trying to set a property. Assume the property is
	 * part of the collection and add it.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @param  mixed   $value
	 * @return void
	 */
	public function __set( string $name, mixed $value ) {

		$this->offsetSet( $name, $value );
	}

	/**
	 * Magic method when trying to unset a property.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return void
	 */
	public function __unset(  string $name ): void {

		$this->offsetUnset( $name );
	}

	/**
	 * Magic method when trying to check if a property has.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return bool
	 */
	public function __isset( string $name ): bool {

		return $this->offsetExists( $name );
	}

	/**
	 * Magic method when trying to get a property.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string  $name
	 * @return mixed
	 */
	public function __get( mixed $name ): mixed {

		return $this->offSetGet( $name );
	}
}
