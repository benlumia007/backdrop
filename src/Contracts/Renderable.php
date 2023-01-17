<?php
/**
 * Renderable contract.
 *
 * Renderable classes should be implemented by a `render()` method.
 * This method should return HTML strings to the screen.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop-contracts
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Contracts;

/**
 * Renderable interface
 *
 * @since  2.0.0
 * @access public
 */
interface Renderable {
	/**
	 * Return a HTML string for output.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function render() : string;
}
