<?php
/**
 * Nav menu functions
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
namespace Backdrop\Theme\Menu;

function display( string $type, array $items = [] ): void {
	foreach ( $items as $item ) {
		switch ( $type ) {
			case 'menu':
				menu( $item );
				break;
			default:
				break;
		}
	}
}

function menu( string $item ): string {

	if ( 'primary' === $item ) {
		if ( has_nav_menu( 'primary' ) ) { ?>
			<nav id="primaire" class="primary-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'backdrop' ); ?></button>
				<?php
				wp_nav_menu( [
					'theme_location' => 'primary',
					'container'      => '',
					'menu_id'        => 'primary-menu',
					'menu_class'     => 'menu-items',
					'depth'          => 2
				] );
				?>
			</nav>
		<?php }
	} elseif ( 'secondary' === $item ) { ?>
		<nav id="secondary" class="secondary-navigation">
			<?php
				wp_nav_menu( [
					'theme_location' => 'secondary',
					'depth'			 => 1,
				] );
			?>
		</nav>
	<?php } elseif ( 'social' === $item ) {
		if ( has_nav_menu( 'social' ) ) { ?>
			<nav id="social" class="site-social">
				<?php
					wp_nav_menu( [
						'theme_location'  => 'social',
						'container'       => 'nav',
						'container_id'    => 'menu-social',
						'container_class' => 'menu-social',
						'menu_id'         => 'menu-social-items',
						'menu_class'      => 'menu-items',
						'depth'           => 1,
						'link_before'     => '<span class="screen-reader-text">',
						'link_after'      => '</span>',
						'fallback_cb'     => '',
					] );
				?>
			</nav>
		<?php }
	}
}
