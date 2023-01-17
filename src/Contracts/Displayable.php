<?php
/**
 * Displayable contract.
 *
 * Displayable classes should be implemented by a `display()` method.
 * This method should output HTML strings to the screen.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop-contracts
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Contracts;

/**
 * Displayable interface
 *
 * @since  2.0.0
 * @access public
 */
interface Displayable {
	/**
	 * Prints the HTML string.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function display() : void;
}
