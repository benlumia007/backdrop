<?php // phpcs:ignore
/**
 * Backdrop Core ( Admin.php )
 *
 * @package     Backdrop Core
 * @copyright   Copyright (C) 2019. Benjamin Lu
 * @license     GNU General PUblic License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://benjlu.com )
 */

namespace Benlumia007\Backdrop\Admin;

use Benlumia007\Backdrop\Contracts\Admin\Admin as AdminPage;

/**
 * Implements Displayable
 */
class Admin extends AdminPage {
	/**
	 * Theme Info
	 */
	private $theme_info = null;
	/**
	 * Construct
	 */
	public function __construct() {
		$this->theme_info = wp_get_theme();
		add_action( 'admin_menu', array( $this, 'menu' ) );
	}
	/**
	 * Register Menu
	 */
	public function menu() {
		add_theme_page( $this->theme_info->name, $this->theme_info->name, 'manage_options', 'theme_page', array( $this, 'callback') );
	}

	/**
	 * Render Menu
	 */
	public function callback() {

		echo '<h1 class="admin-title">' . $this->theme_info->name . '</h1>';
		$this->tabs();
	}

	public function tabs( $current = 'introduction' ) {
		$tabs = array(
			'introduction' => esc_html__( 'Introduction', 'backdrop-core' ),
			'installation' => esc_html__( 'Installation', 'backdrop-core'),
		);

		$admin_nonce = wp_create_nonce( 'admin_nonce' );

		echo '<h2 class="tabs">';
			foreach ( $tabs as $tab => $name ) {
				$class = ( $tab === $current ) ? 'active' : '';
				echo "<a class='nav-tab $class' href='?page=theme_page&tab=$tab&_wp_nonce=$admin_nonce'>$name</a>"; // XSS OK.
			}
		echo '</h2>';

		echo '<div class="admin-content">';
		if ( isset( $_GET['tab'] ) && isset( $_GET['_wp_nonce'] ) && false !== wp_verify_nonce( $_GET['_wp_nonce'], 'admin_nonce' ) ) {
			if ( $current === $_GET['tab'] ) {
				$this->introduction();
			} elseif ( $_GET['tab'] === $tab ) {
				$this->installation();
			}
		}
		echo '</div>';
	}

	public function introduction() {
		echo '<h2 class="admin-title">' . esc_html__( 'Introduction', 'backdrop-core' ) . '</h2>';


	}
	
	public function installation() {
		echo '<h2 class="admin-title">' . esc_html__( 'Installation', 'backdrop-core' ) . '</h2>';
	}
}