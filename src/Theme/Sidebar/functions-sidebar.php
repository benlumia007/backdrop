<?php
/**
 * Sidebar functions
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop-theme
 */

/**
 * Define namespace
 */
namespace Backdrop\Theme\Sidebar;

function display( $type, $items = [] ): void {

	foreach ( $items as $item ) {

		switch ( $type ) {
			case 'sidebar': ?>
				<div id="aside" class="widget-area">
					<?php dynamic_sidebar( $item ); ?>
				</div>
				<?php
				break;
			default:
				break;
		}
	}
}
