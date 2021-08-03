<?php
/**
 * Backdrop Core ( src/Contracts/Sidebar/Sidebar.php )
 *
 * @package   Backdrop Core
 * @copyright Copyright (C) 2019-2021. Benjamin Lu
 * @license   GNU General PUblic License v2 or later ( https://www.gnu.org/licenses/gpl-2.0.html )
 * @author    Benjamin Lu ( https://getbenonit.com )
 */

/**
 * Define namespace
 */
namespace Benlumia007\Backdrop\Contracts\Component;
use Benlumia007\Backdrop\Contracts\Bootable;

/**
 * Sidebar Interface
 *
 * @since  3.0.0
 * @access public
 */
interface Sidebar extends Bootable {
	/**
	 * Construct
	 */
	public function __construct( $sidebar_id = [] );

	/**
	 * Register register_panels
	 */
	public function register();
	
	/**
	 * Register register_sections
	 */
	public function create( string $name, string $id, string $desc );
}