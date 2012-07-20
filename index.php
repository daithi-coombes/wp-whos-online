<?php
/**
 * @package wp-whos-online
 */
/*
Plugin Name: WP Who's Online
Plugin URI: http://wp.david-coombes.com/wp-whos-oline
Description: Monitor online users. Plugin will update with more options as revisions are done.
Version: 0.1
Author: David Coombes
Author URI: http://david-coombes.com
*/

//debug?
error_reporting(E_ALL);
ini_set('display_errors','on');

//constants
define("WPWHO_ONLINE_DIR", WP_PLUGIN_DIR . basename(dirname(__FILE__)));
define("WPWHO_ONLINE_URL", WP_PLUGIN_URL . basename(dirname(__FILE__)));
?>