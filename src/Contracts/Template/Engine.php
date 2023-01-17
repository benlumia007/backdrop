<?php
/**
 * Engine interface
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop-template-view
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Backdrop\Contracts\Template;

use Backdrop\Tools\Collection;

/**
 * Engine interface.
 *
 * @since  1.0.0
 * @access public
 */
interface Engine {

	/**
	 * Returns a View object.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string	$name
	 * @param  array	$slugs
	 * @param  array	$data
	 * @return View
	 */
	public function view( string $name, array $slugs = [], array $data = [] ): View;

	/**
	 * Outputs a view template.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string	$name
	 * @param  array	$slugs
	 * @param  array	$data
	 * @return void
	 */
	public function display( string $name, array $slugs = [], array $data = [] ): void;

	/**
	 * Returns a view template as a string.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string	$name
	 * @param  array	$slugs
	 * @param  array 	$data
	 * @return string
	 */
	function render( string $name, array $slugs = [], array $data = [] ): string;
}
