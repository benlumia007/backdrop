<?php
/**
 * Bootable interface.
 *
 * The bootable classes should have a `boot()` method for
 * booting actions and filters which should be kept out of the
 * constructor.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop\Contracts;

/**
 * Bootable interface.
 *
 * @since  2.0.0
 * @access public
 */
interface Bootable {
	/**
	 * Boots the class by running `add_action()` and `add_filter()` calls.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return void
	 */
	public function boot() : void;
}
