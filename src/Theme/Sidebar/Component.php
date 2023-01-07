<?php
/**
 * Backdrop Core ( src/Sidebar/Sidebar.php )
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

use Backdrop\Contracts\Bootable;

/**
 * Register Sidebar
 */
class Component implements Bootable {
	/**
	 * $post post.
	 *
	 * @var string
	 */
	public string $sidebar_id;

	/**
	 * Construct
	 *
	 * @param array $sidebar_id array.
	 */
	public function __construct( array $sidebar_id = [] ) {
		$this->sidebar_id = $this->sidebars();
	}

	/**
	 * Register Custom Sidebar
	 */
	public function register(): void {

		foreach ( $this->sidebar_id as $key => $value ) {

			$this->create( $value['name'], $key, $value['desc'] );
		}
	}

	/**
	 * Create Sidebar
	 *
	 * @param string $name outputs name.
	 * @param string $id displays id for sidebar.
	 * @param string $desc displays description.
	 */
	public function create( string $name, string $id, string $desc ) {
		$args = [
			'name'          => $name,
			'id'            => $id,
			'description'   => $desc,
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		];
		register_sidebar( $args );
	}

	public function boot() : void {
		add_action( 'widgets_init', [ $this, 'register' ] );
	}
}
