<?php
/**
 * Customize component.
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
namespace Backdrop\Customize;

use Backdrop\Contracts\Bootable;

use WP_Customize_Manager;

/**
 * Customize class.
 *
 * @since  1.0.0
 * @access public
 */
class Component implements Bootable {

	/**
	 * Add our panels for customizer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param WP_Customize_Manager $manager
	 * @return void
	 */
	public function panels( WP_Customize_Manager $manager ): void {}

	/**
	 * Add our sections for customizer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param WP_Customize_Manager $manager
	 * @return void
	 */
	public function sections( WP_Customize_Manager $manager ): void {}

	/**
	 * Add our settings for customizer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param WP_Customize_Manager $manager
	 * @return void
	 */
	public function settings( WP_Customize_Manager $manager ): void {}

	/**
	 * Add our controls for customizer.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param WP_Customize_Manager $manager
	 * @return void
	 */
	public function controls( WP_Customize_Manager $manager ): void {}

	/**
	 * Sets up the customizer manager actions and filters.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function boot(): void {
		add_action( 'customize_register', [ $this, 'panels' ] );
		add_action( 'customize_register', [ $this, 'sections' ] );
		add_action( 'customize_register', [ $this, 'settings' ] );
		add_action( 'customize_register', [ $this, 'controls' ] );
	}
}
