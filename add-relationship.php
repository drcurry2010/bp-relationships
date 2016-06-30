<?php

//$rel_user_id = $_POST["rel_user_id"];
$rel_user_id = 2;
$rel_user_role = $_POST["rel_user_role"];
$rel_friend_id = $_POST["rel_friend_id"];
$rel_friend_role = $_POST["rel_friend_role"];

//** SQL Database Connection **//
$db = new PDO('mysql:host=localhost;dbname=digidung;charset=utf8mb4', 'root', 'dC20011626.');

try {
	$new_rel = $db->prepare("
	INSERT INTO dd_bp_user_relationships (init_id,init_role,targ_id,targ_role) 
	VALUES (
		:user_id, :user_role, :friend_id, :friend_role
	)");

	$new_rel->execute( array( 
		':user_id' => "$rel_user_id",
		':user_role' => "$rel_user_role",
		':friend_id' => "$rel_friend_id",
		':friend_role' => "$rel_friend_role"
	) );

} catch(PDOException $ex) {
    echo "An error occured.";
    some_logging_function($ex->getMessage());
}

try {
	$rel_info = $db->prepare("
	SELECT * FROM dd_users WHERE ID = :friend_id");

	$rel_info->execute( array( 
		':friend_id' => "$rel_friend_id"
	) );

	$friend = $rel_info->fetch();

	$friend_info = print_r ($friend);

	/*echo "<h1>Congratulations!</h1>
		<p>You have successfully requested a relationship with "
		 . $friend_info['display_name'] . " ("
		 . $rel_targ_role . "), as their "
		 . $rel_init_role . ". 
		Once they accept your request, your new relationship will 
		display automatically from this profile tab.</p>";*/

} catch(PDOException $ex) {
    echo "An error occured.";
    some_logging_function($ex->getMessage());
}

?>
