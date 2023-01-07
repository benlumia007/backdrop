<?php
/**
 * Engine interface
 *
 * Engine classes are wrappers around the View system.
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

/**
 * Engine interface.
 *
 * @since  2.0.0
 * @access public
 */
interface Engine {
	/**
	 * Returns a View object.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string	$name
	 * @param  array	$slugs
	 * @param  array	$data
	 * @return void
	 */
	public function view( string $name, array $slugs = [], array $data = [] ): void;

	/**
	 * Outputs a view template.
	 *
	 * @since  2.0.0
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
	 * @since  2.0.0
	 * @access public
	 * @param  string	$name
	 * @param  array	$slugs
	 * @param  array	$data
	 * @return void
	 */
	public function render( string $name, array $slugs = [], array $data = [] );
}
