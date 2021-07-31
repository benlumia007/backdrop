<?php //phpcs:ignore
/**
 * Backdrop Core ( functions-template.php )
 *
 * @package     Backdrop Core
 * @copyright   Copyright (C) 2019-2020. Benjamin Lu
 * @license     GNU General PUblic License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://benjlu.com )
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Template;

/**
 * Return the relative path to where templates are held in the theme
 * 
 * @since  2.0.0
 * @access public
 * @param  string $file 
 * @return string
 */
function path( $file = '' ) {
	$file = ltrim( $file, '/' );
	$path = apply_filters( 'backdrop/template/path', 'resources/views' );

	return $file ? $path . $file : $path;
}

/**
 * Output get_template_part();
 * 
 * @since  2.0.0
 * @access public
 */
function get_template_part( $slug, $name = '' ) {
	$path = path();

	do_action( "get_template_part_{$slug}", $slug, $name );

	$templates = [];

	if ( $name ) {
		$templates[] = "{$path}/{$slug}-{$name}.php";
		$templates[] = "{$path}/{$slug}/{$name}.php";
	}

	$templates[] = "{$path}/{$slug}.php";
	$templates[] = "{$path}/{$slug}/{$slug}.php";

	$templates = apply_filters( "backdrop/{$slug}/template_hierarchy", $templates, $name );
	$template  = apply_filters( "backdrop/{$slug}/template", locate_template( $templates ), $name );

	if ( $template ) {
		include( $template ); // phpcs:ignore
	}

}

/**
 * A better `locate_template()` function than what core WP provides. Note that
 * this function merely locates templates and does no loading. Use the core
 * `load_template()` function for actually loading the template.
 *
 * @since  5.0.0
 * @access public
 * @param  array|string  $templates
 * @return string
 */
function locate( $templates ) {
	$located = '';

	foreach ( (array) $templates as $template ) {

		foreach ( locations() as $location ) {

			$file = trailingslashit( $location ) . $template;

			if ( file_exists( $file ) ) {
				$located = $file;
				break 2;
			}
		}
	}

	return $located;
}