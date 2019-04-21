<?php
/**
 * Backdrop Core ( framework.php )
 *
 * @package     Backdrop Core
 * @copyright   Copyright (C) 2019. Benjamin Lu
 * @license     GNU General PUblic License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author      Benjamin Lu ( https://benjlu.com )
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Site;

/**
 * Displays Site Title
 *
 * @since 1.0.0
 * @param array $args outputs site title.
 */
function display_title( array $args = [] ) {
	$args = wp_parse_args(
		$args,
		[
			'tags'  => 'h1',
			'class' => 'site-title',
		]
	);

	$html = '';

	$title = get_bloginfo( 'name', 'display' );

	if ( $title ) {
		$link = home_link(
			[
				'text'  => $title,
				'class' => $args['class'],
			]
		);

		$html = printf(
			'<%1$s class="%2$s">%3$s</a>',
			tag_escape( $args['tags'] ),
			esc_attr( $args['class'] ),
			$link // phpcs:ignore
		);
	}
	return apply_filters( 'backdrop_site_title', $html );
}

/**
 * Displays Site Description
 *
 * @since 1.0.0
 * @param array $args outputs site description.
 */
function display_description( array $args = [] ) {
	$args = wp_parse_args(
		$args,
		[
			'tag'   => 'h3',
			'class' => 'site-description',
		]
	);

	$html = '';

	$description = get_bloginfo( 'description', 'display' );

	if ( $description ) {
		$html = printf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			tag_escape( $args['tag'] ),
			esc_attr( $args['class'] ),
			$description // phpcs:ignore 
		);
	}
	return apply_filters( 'backdrop_site_description', $html );
}

/**
 * Renders home_link();
 *
 * @since 1.0.0
 * @param array $args outputs home_link for site title.
 */
function home_link( array $args = [] ) {
	$args = wp_parse_args(
		$args,
		[
			'text'   => '%s',
			'before' => '',
			'after'  => '',
		]
	);

	$html = sprintf(
		'<a href="%1$s">%2$s</a>',
		esc_url( home_url( '/' ) ),
		sprintf( $args['text'], get_bloginfo( 'name' ) )
	);

	return apply_filters(
		'backdrop_home_link',
		$args['before'] . $html . $args['after']
	);
}