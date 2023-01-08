<?php

namespace Backdrop\Helpers;

if ( ! function_exists( __NAMESPACE__ . '\\locate' ) ) {
	/**
	 * A better `locate_template()` function than what core WP provides.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  array|string  $templates
	 * @return string
	 */
	function locate( array|string $templates ): string {

		$located = '';

		foreach ( ( array ) $templates as $template ) {

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
}

if ( ! function_exists( __NAMESPACE__ . '\\locations' ) ) {

	/**
	 * Returns an array of locations to look for templates.
	 *
	 * Note that this won't work with the core WP template hierarchy due to an
	 * issue that hasn't been addressed since 2010.
	 *
	 * @link   https://core.trac.wordpress.org/ticket/13239
	 * @since  2.0.0
	 * @access public
	 * @return array
	 */
	function locations(): array {

		$path = ltrim( path(), '/' );

		// Add active theme path.
		$locations = [ get_stylesheet_directory() . "/{$path}" ];

		// If child theme, add parent theme path second.
		if ( is_child_theme() ) {

			$locations[] = get_template_directory() . "/{$path}";
		}

		return ( array) apply_filters( 'backdrop/template/locations', $locations );
	}
}

if ( ! function_exists( __NAMESPACE__ . '\\filter_templates'  ) ) {
	/**
	 * Filters an array of templates and prefixes them with the view path.
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  array  $templates
	 * @return array
	 */
	function filter_templates( array $templates ): array {
		$path = path();

		if ( $path ) {
			array_walk( $templates, function( &$template, $key ) use ( $path ) {

				$template = ltrim( str_replace( $path, '', $template ), '/' );

				$template = "{$path}/{$template}";
			} );
		}

		return $templates;
	}
}

if ( ! function_exists( __NAMESPACE__ . '\\path' ) ) {
	/**
	 * Return the relative path to where templates are held in the theme
	 *
	 * @since  2.0.0
	 * @access public
	 * @param  string $file
	 * @return string
	 */
	function path( string $file = '' ): string {
		$file = ltrim( $file, '/' );
		$path = apply_filters( 'backdrop/template/path', 'public/views' );

		return $file ? trailingslashit( $path ) . $file : trailingslashit( $path );
	}
}


/**
 * Helper functions
 *
 * Helpers are functions designed for quickly accessing data from the container
 * that we need throughout the framework.
 *
 * @package   Backdrop
 * @author    Benjamin Lu <benlumia007@gmail.com>
 * @copyright 2019-2023. Benjamin Lu
 * @link      https://github.com/benlumia007/backdrop
 * @license   https://www.gnu.org/licenses/gpl-2.0.html
 */

namespace Backdrop;

use Backdrop\App;

if (!function_exists(__NAMESPACE__ . '\\booted')) {
	/**
	 * Conditional function for checking whether the application has been
	 * booted. Use before launching a new application. If booted, reference
	 * the `app()` instance directly.
	 *
	 * @return bool
	 * @since  2.0.0
	 * @access public
	 */
	function booted(): bool
	{
		return defined('BACKDROP_BOOTED') && true === BACKDROP_BOOTED;
	}
}

if (!function_exists(__NAMESPACE__ . '\\app')) {
	/**
	 * The single instance of the app. Use this function for quickly working
	 * with data.  Returns an instance of the `\Hybrid\Core\Application`
	 * class. If the `$abstract` parameter is passed in, it'll resolve and
	 * return the value from the container.
	 *
	 * @param string $abstract
	 * @param array $params
	 * @return mixed
	 * @since  2.0.0
	 * @access public
	 */
	function app(string $abstract = '', array $params = [])
	{

		return App::resolve($abstract ?: 'app', $params);
	}
}
