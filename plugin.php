<?php
/*
Plugin Name: Marketing Material Branding and Distribution Blog Options
Plugin URI: http://localhost
Description: Custom Settings for  Marketing Material Branding Blogs
Version: 1.0
Author: Earnnest Capili
Author URI: http://localhost
License: GPL2
*/

include_once dirname( __FILE__ ) . '/settings.php';
if (is_admin){

	new mmbd_settings();
	
}

?>