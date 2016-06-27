<?php
/**
 * @package BP User Relationship Plugin
 * @version 1.0
 */
/*
Plugin Name: BP Relationships
Plugin URI: http://github.com/drcurry2010/bp-relationships/
Description: Creates user relationships between BP installation members.
Author: DR Curry
Version: 1.0
Author URI: http://outlawnerd.tk
Tags: buddypress
*/

include 'functions.php';

register_activation_hook( __FILE__, 'bp_rel_table_create' );

?>
