<?php
/**
 * Template interface.
 *
 * Defines the interface that template classes must use.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-template-manager
 */

/**
 * Define namespace
 *
 * @since  2.0.0
 * @access public
 */
namespace Backdrop\Contracts\Template;

/**
 * Template interface.
 *
 * @since  2.0.0
 * @access public
 */
interface Template {
	/**
	 * Returns the filename relative to the templates location.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function filename(): string;

	/**
	 * Returns the internationalized text label for the template.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return string
	 */
	public function label(): string;

	/**
	 * Conditional function to check what type of template this is.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return bool
	 */
	public function isType( $type ): bool;

	/**
	 * Conditional function to check if the template has a specific subtype.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return bool
	 */
	public function hasSubtype( $subtype ): bool;

	/**
	 * Conditional function to check if the template is for a post type.
	 *
	 * @since  2.0.0
	 * @access public
	 * @return bool
	 */
	public function forPostType( $type ): bool;
}
