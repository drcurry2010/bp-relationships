<?php
/**
 * @package BP User Relationship Plugin
 * @version 1.0
 */
/*
Plugin Name: BP Relationships
Description: Creates user relationships between BP installation members.
Author: DR Curry
Version: 1.0
Author URI: http://outlawnerd.tk
*/

//** Specifies the relationship table for database **//

	function bp_relationship_db() {

		global $wpdb;

		global $bp_user_relationships;

		$bp_user_relationships = $wpdb->prefix . 'bp_user_relationships';

		global $charset_collate;
		
		$charset_collate = $wpdb->get_charset_collate();

		if ($wpdb->get_var( "SHOW TABLES LIKE '$bp_user_relationships'" ) != bp_user_relationships ) {
			$sql = "CREATE TABLE $bp_user_relationships (
				id mediumint(9) NOT NULL AUTO_INCREMENT,
				initiator_user_id int(6) NOT NULL,
				friend_user_id int(6) NOT NULL,
				is_confirmed int(2) NOT NULL,
				relation_status text(50) NOT NULL,
				init_position text(50) NOT NULL,
				friend_position text(50) NOT NULL,
				UNIQUE KEY id (id)
				) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
	}

//** Creates the database table at installation **//
register_activation_hook( __FILE__, 'bp_relationship_db' );

?>
