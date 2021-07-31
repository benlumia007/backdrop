<?php
/**
 * Backdrop Core ( src/Contracts/Bootable.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General PUblic License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */

/**
 * Define namespace
 * 
 * @since  2.0.0
 * @access public
 */
namespace Benlumia007\Backdrop\Templates;
use Benlumia007\Backdrop\Contracts\Bootable;

/**
 * Template Hierarchy Template
 * 
 * @since  2.0.0
 * @access public
 */
interface Hierarchy extends Bootable {
    /**
     * Filters a queried template hierarchy for each type of template
     * and looks templates within `resources/views'.
     * 
     * @since  2.0.0
     * @access public
     * @return array
     */
    public function templateHierarchy( $templates );

    /**
     * Filters the template for each type of template in the hierarchy.
     * If `$templates` exists, it means we've located a template, so
     * we are going to store that template for later use and return
     * an empty string so that the template hierarchy continues processing.
     * This way, we can capture the entire hierarchy.
     * 
     * @since  2.0.0
     * @access public
     * @param  string $template
     */
    public function template( $templates );
    
    /**
     * Filters on  `template_include` to make sure we fall
     * back to our template from earlier.
     * 
     * @since  2.0.0
     * @access public
     * @param  string $template
     * @return string
     */
    public function templateInclude( $template );
}



