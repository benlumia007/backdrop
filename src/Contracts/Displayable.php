<?php
/**
 * Backdrop Core ( src/Contracts/Displayable.php )
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
 * Displayable interface
 * 
 * @since  3.0.0
 * @access public
 */
interface Displayable {
    /**
	 * Prints the HTML string.
	 *
	 * @since  3.0.0
	 * @access public
	 * @return void
	 */
	public function display();
}