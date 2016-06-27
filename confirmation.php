<?php

session_start();

$rel_id = $_SESSION["rel_id"];

if ($_POST["confirm"] == "Accept") {

	$rel_conf = 1;

} elseif ($_POST["confirm"] == "Reject") {

	$rel_conf = 0;

}

//** SQL Database Connection **//
$db = new PDO('mysql:
	host=localhost;
	dbname=digidung; 
	charset=utf8mb4', 'root', 'dC20011626.');

try {
	$new_rel = $db->prepare("
	UPDATE dd_bp_user_relationships 
	SET rel_conf = '" . $rel_conf . "' 
	WHERE rel_id = '" . $rel_id . "'
	");

	$new_rel->execute();

	echo "	<h1>Congratulations!</h1>
		<p>You have successfully " . $_POST["confirm"] . "ed the relationship request.";

} catch(PDOException $ex) {
    echo "An error occured.";
    some_logging_function($ex->getMessage());
}

session_unset();

session_destroy();

?>
