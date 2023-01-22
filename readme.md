# Backdrop: Themes & Plugins Framework
Backdrop is a framework for developing themes & plugins for ClassicPress and WordPress.

Backdrop is the core application layer that consists of a service container and it can be use alone or alongside with Backdrop's available packages.

## Requirements
- ClassicPress 1.4+
- WordPress 4.9+
- PHP 7.0+
- [Composer](https://getcomposer.org) for managing PHP dependencies

## Documentations
The documentation is under construction and will be available when I finished writing up everything I need.

## Installation
Use the following command from your preferred command line utility to install Backdrop.

<pre>
composer require benlumia007/backdrop
</pre>

## Themes
if bundling this directly in your theme, add the following code.
<pre>
if ( file_exists( get_parent_theme_file_path( 'vendor/autoload.php' ) ) ) {
	require_once( get_parent_theme_file_path( 'vendor/autoload.php' ) );
}
</pre>

## Plugins
if bundling this directly in your plugin, add the following code.
<pre>
if ( file_exists( plugin_dir_path( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';
}
</pre>
