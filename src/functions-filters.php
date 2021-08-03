<?php 


/**
 * Overrides the default comments template.  This filter allows for a
 * `comments-{$post_type}.php` template based on the post type of the current
 * single post view.  If this template is not found, it falls back to the
 * default `comments.php` template.
 *
 * @since  5.0.0
 * @access public
 * @param  string $template
 * @return string
 */
add_filter( 'comments_template', function( $template ) {
	$templates = [];

	// Allow for custom templates entered into comments_template( $file ).
	$template = str_replace( trailingslashit( get_stylesheet_directory() ), '', $template );

	if ( 'comments.php' !== $template ) {
		$templates[] = $template;
	}

	// Add a comments template based on the post type.
	$templates[] = sprintf( 'comments/%s.php', get_post_type() );

	// Add the default comments template.
	$templates[] = 'comments/default.php';
	$templates[] = 'comments.php';

	// Return the found template.
	return locate_template( $templates );
} );