<?php
/**
 * FontAwesome component
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 * @link      https://github.com/benlumia007/backdrop/fontawesome
 */

/**
 * Define namespace
 */
namespace Backdrop\Assets\FontAwesome;

use Backdrop\Contracts\Bootable;

/**
 * Register Menu Class
 */
class Component implements Bootable {
	/**
	 * Loads theme_enqueue();
	 *
	 * The theme_enqueue(); is used to define any scripts and styles that's going to be used part of a theme.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue(): void {

		wp_enqueue_style( 'backdrop-fontawesome', get_theme_file_uri( '/vendor/benlumia007/backdrop/assets/fontawesome/css/all.css' ), array(), '1.0.0' );
	}

	public function boot() : void {

		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
	}
}
