<?php
/**
 * Backdrop Core ( src/Menu/Menu.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @author    Benjamin Lu ( https://getbenonit.com )
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Component;
use Benlumia007\Backdrop\Contracts\Component\Menu as MenuContracts;

/**
 * Regiser Menu Class
 */
class Menu implements MenuContracts {
	/**
	 * Menu
	 *
	 * @var string
	 */
	public $menu_id;

	/**
	 * Construct
	 *
	 * @param string $menu_id string.
	 */
	public function __construct( $menu_id = [] ) {
		$this->menu_id = array_merge( $menu_id );
	}

	/**
	 * Register Custom Menus
	 */
	public function register() {
		foreach ( $this->menu_id as $key => $value ) {
			$this->create( $value, $key );
		}
	}

	/**
	 * Create Menus
	 *
	 * @param string $name outputs name.
	 * @param string $id output id.
	 */
	public function create( string $name, string $id ) {
		$args = [
			$id => $name,
		];
		register_nav_menus( $args );
	}

	public function enqueue() {
		/**
		 * We will be enqueue the app.js file, which mainly be for the navigation only.
		 */
		wp_enqueue_script( 'backdrop-core-navigation', get_theme_file_uri( 'vendor/benlumia007/backdrop-core/assets/js/navigation.js' ), array('jquery'), '3.0.0', true );
		wp_localize_script( 'backdrop-core-navigation', 'backdropCoreScreenReaderText', array(
			'expand'   => '<span class="screen-reader-text">' . esc_html__( 'expand child menu', 'backdrop-core' ) . '</span>',
			'collapse' => '<span class="screen-reader-text">' . esc_html__( 'collapse child menu', 'backdrop-core' ) . '</span>',
		) );
	}

	public function boot() {
		add_action( 'after_setup_theme', [ $this, 'register' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue' ] );
	}
}