<?php
/**
 * Backdrop Core ( Admin.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2020. Benjamin Lu
 * @license   GNU General PUblic License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://benjlu.com )
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Contracts\Component;
use Benlumia007\Backdrop\Contracts\Bootable;

/**
 * Admin
 */
interface Admin extends Bootable {
	/**
	 * menu()
	 * 
	 * @since  3.0.0
	 * @access public
	 */
	public function menu();

	/**
	 * callback()
	 * 
	 * @since  3.0.0
	 * @access public
	 */
	public function callback();

	/**
	 * tabs()
	 * 
	 * @since  3.0.0
	 * @access public
	 */
	public function tabs();

	/**
	 * pages()
	 * 
	 * @since  3.0.0
	 * @access public
	 */
	public function pages();
}
