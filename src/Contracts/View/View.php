<?php
/**
 * View interface
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
namespace Backdrop\Contracts\View;

use Backdrop\Contracts\Displayable;
use Backdrop\Contracts\Renderable;
/**
 * View interface.
 *
 * @since  1.0.0
 * @access public
 */
interface View extends Renderable, Displayable {

	/**
	 * Returns the array of slugs.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return array
	 */
	public function slugs(): array;

	/**
	 * Returns the absolute path to the template file.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function template(): string;
}
