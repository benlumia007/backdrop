<?php
/**
 * Backdrop Core ( src/Contracts/Bootable.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @author    Benjamin Lu ( https://getbenonit.com )
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Contracts;

/**
 * Bootable Interface
 * 
 * @since  3.0.0
 * @access public
 */
interface Bootable {
    /**
	 * Boots the class by running `add_action()` and `add_filter()` calls.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function boot();
}