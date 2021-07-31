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
