<?php
/**
 * @package BP User Relationship Plugin
 * @version 1.0
 * 
 */

	//** Checks for/creates "bp_user_relationship" table on install. **//
	function bp_rel_table_create() {
		
		
		//** Global Variables **//

		global $wpdb;
		global $bp_relationship_info;
		global $bp_user_info;
		global $bp_friend_info;
		global $charset_collate;
		

		//** Internal Variables **//

		$bp_relationship_info = $wpdb->prefix . 'bp_user_relationships';
		$bp_user_info = $wpdb->prefix . 'users';
		$bp_friend_info = $wpdb->prefix . 'bp_friends';
		$charset_collate = $wpdb->get_charset_collate();


		//** Core Function **//

		if ($wpdb->get_var( "SHOW TABLES LIKE '$bp_relationship_info'" ) != bp_user_relationships ) {
			
			$sql = "CREATE TABLE $bp_relationship_info (

				rel_id mediumint(9) NOT NULL AUTO_INCREMENT,
				init_id mediumint(9) NOT NULL,
				targ_id mediumint(9) NOT NULL,
				init_role varchar(50) NOT NULL,
				targ_role varchar(50) NOT NULL,
				rel_conf tinyint(1) DEFAULT NULL,
				UNIQUE KEY id (rel_id)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );

		}

	}

	//** Checks table for/displays (as requests and only to user) any relationships.  **//
	function bp_rel_request() {}

	//** Adds table row with user/relationship info, when user submits request. **//
	function bp_rel_addrow() {}

	//** Updates table row (rel_conf) to either 0 or 1, when user confirms. **//
	function bp_rel_confirm() {}

	//** Creates BP profile tab for Relationships ** //
	function profile_tab_relationships() {
	  global $bp;
	  bp_core_new_nav_item( array( 
	    'name' => __( 'Relationships' ), 
	    'slug' => 'relationships', 
	    'screen_function' => 'relationships_screen', 
	    'position' => 40 ) 
	  );

	  function relationships_screen() {
    	//add title and content here – last is to call the members plugin.php template
	    add_action( 'bp_template_title', 'relationships_title' );
	    add_action( 'bp_template_content', 'relationships_content' );
	    bp_core_load_template( apply_filters( 'bp_core_template_plugin', 	'buddypress/members/single/plugins' ) );
	  }
	
	  function relationships_title() {
	    echo 'Relationships';
	  }
	
	  function relationships_content() {
	    echo 'Content';
	  }
	}

?>
