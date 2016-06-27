<?php
/**
 * @package BP User Relationship Plugin
 * @version 1.0
 * 
 */

	//** Checks table for/displays all relationships, where rel_conf = 1. **//
	function bp_rel_display() { ?>
		<select name="friend-list">
		    <option name="null" value="null"> - Select a Friend - </option>
	<?php
		$user_id = get_current_user_id();
		$friend_id = $wpdb->get_results( "SELECT initiator_user_id FROM '" . $bp_friend_info . "' WHERE friend_user_id = '" . $user_id . "' AND is_confirmed = 1 UNION ALL SELECT friend_user_id FROM '" . $bp_friend_info . "' WHERE initiator_user_id = '" . $user_id . "' AND is_confirmed = 1" );
		$friend_name = $wpdb->get_results( "SELECT display_name FROM '" . $bp_user_info . "' WHERE ID = '" . $friend_id . "'" );
		printf('<option name="%s" value="%s">%s</option>', $friend_name, $friend_name, $friend_name );
	}
?></select><?php

bp_core_new_nav_item( 
    array( 
        'name' => __('Relationships', 'buddypress'), 
        'slug' => $bp->messages->slug, 
        'position' => 45, 
        'show_for_displayed_user' => false, 
        'screen_function' => 'bp_rel_display', 
        'default_subnav_slug' => 'Add', 
        'item_css_id' => $bp->messages->id 
    ));

/* function my_test_setup_nav() {

	global $bp;

	bp_core_new_nav_item( 
		array( 
			‘name’ => __( ‘Relationships’ ), 
			‘slug’ => ‘relationships’, 
			‘parent_url’ => $bp->loggedin_user->domain . $bp->slug . ‘/’, 
			‘parent_slug’ => $bp->slug, 
			‘screen_function’ => ‘my_profile_page_function_to_show_screen’, 
			‘position’ => 40 
		) 
	);
	
	bp_core_new_subnav_item( 
		array( 
			‘name’ => __( ‘Home’ ), 
			‘slug’ => ‘rel_sub’, 
			‘parent_url’ => $bp->loggedin_user->domain . $bp->slug . ‘/’, 
			‘parent_slug’ => $bp->slug, 
			‘parent_slug’ => $bp->slug, 
			‘screen_function’ => ‘my_profile_page_function_to_show_screen’, 
			‘position’ => 20, 
			‘item_css_id’ => ‘test_activity’ 
		) 
	);
	
	function my_profile_page_function_to_show_screen() {
		//add title and content here – last is to call the members plugin.php template
		add_action( ‘bp_template_title’, ‘my_profile_page_function_to_show_screen_title’ );
		add_action( ‘bp_template_content’, ‘my_profile_page_function_to_show_screen_content’ );
		bp_core_load_template( apply_filters( ‘bp_core_template_plugin’, ‘members/single/plugins’ ) );
	}
	
	function my_profile_page_function_to_show_screen_title() {
		echo ‘something’;
	}
	
	function my_profile_page_function_to_show_screen_content() {
		echo ‘weee content’;
		echo bp_rel_display();
	}

} */

add_action( ‘bp_setup_nav’, ‘my_test_setup_nav’ );

?>
