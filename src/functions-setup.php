<?php
/**
 * Backdrop Core
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
namespace Backdrop;

use function Backdrop\Template\Helpers\path;

/**
 * This function is for adding extra support for features not default to the core post types.
 * Excerpts are added to the 'page' post type.  Comments and trackbacks are added for the
 * 'attachment' post type.  Technically, these are already used for attachments in core, but
 * they're not registered.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function post_type_support(): void {

	add_post_type_support( 'page', 'excerpt' );
}

/**
 * Add Comment Templates
 */
function comments_template( $template ) {
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
}

/**
 * Filters the excerpt more output with internationalized text and a link to the post.
 *
 * @since  1.0.0
 * @access public
 * @param  string  $text
 * @return string
 */
function excerpt_more( string $text ): string {

	if (! str_starts_with( $text, '<a')) {

		$text = sprintf(
			' <a href="%s" class="entry__more-link">%s</a>',
			esc_url( get_permalink() ),
			trim( $text )
		);
	}

	return $text;
}
