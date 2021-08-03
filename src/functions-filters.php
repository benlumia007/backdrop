<?php
/**
 * Backdrop Core
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General Public License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */
use function Benlumia007\Backdrop\Template\path;

add_filter( 'comments_template', function( $template ) {
	$templates = [];
    $path = path();

	// Allow for custom templates entered into comments_template( $file ).
	$template = str_replace( trailingslashit( get_stylesheet_directory() ), '', $template );

	$template = $path . $template;

	if ( 'comments.php' !== $template ) {
		$templates[] = $template;
	}

	// Add a comments template based on the post type.
	$templates[] = sprintf( 'comments/%s.php', get_post_type() );

	// Add the default comments template.
	$templates[] = "{$path}/comments/default.php";
	$templates[] = 'comments.php';

	// Return the found template.
	return locate_template( $templates );
} );