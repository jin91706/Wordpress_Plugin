<?php

/**
 * 
 * @since             1.0.0
 * @package           email_page
 *
 * @wordpress-plugin
 * Plugin Name:       Email and Pages
 * Description:       Create pages and forms. Send emails
 * Version:           1.0.0
 * Author:            James Sedillo
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       email_page
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

spl_autoload_register(function($className) {
	$className = str_replace("\\", DIRECTORY_SEPARATOR, $className);
	$dir = plugin_dir_path( __FILE__ );
	include_once $dir . 'src/' . $className . '.php';
});


new Bootstrap\EmailPageBootstrapper(__FILE__);
new Admin\Admin(__FILE__);
new Controllers\PostController();
