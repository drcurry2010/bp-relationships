<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "dC20011626.";
$dbname = "digidung";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<link rel="stylesheet" href="css/styles.css" type="text/css" media="all" />
<body>
<form action="add-relationship.php" method="POST">
<div class="add-rel">
<h1>Add a relationship</h1>
  <div class="addrel-friend-name">
    My friend: <br />
    <select name="rel_friend_id" id="rel_friend_id">
	<option name="null" value="null"> - Select a Friend - </option>

<?php

$sql1 = "SELECT initiator_user_id FROM dd_bp_friends WHERE friend_user_id = 2 AND is_confirmed = 1 UNION ALL SELECT friend_user_id FROM dd_bp_friends WHERE initiator_user_id = 2 AND is_confirmed = 1";

$result = $conn->query($sql1);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {

	$friend_id = $row["initiator_user_id"];

	$sql2 = "SELECT display_name FROM dd_users WHERE ID = '" . $friend_id . "'";  

	$result2 = $conn->query($sql2);

		if ($result2->num_rows > 0) {

    			while($row2 = $result2->fetch_assoc()) {

				$friend_name = $row2["display_name"];
				
				printf('<option name="user-%s" value="%s">%s</option>', $friend_name, $rel_friend_id = $friend_id, $friend_name );
	
   			}

		}

    }

}

?></select>
  </div>

  <div class="addrel-friend-role">
    is my:<br />
    <select name="rel_friend_role">
	<option name="null" value="null"> - Select a Role - </option>
	<option value="Submissive">Submissive</option>
	<option value="Slave">Slave</option>
	<option value="Dominant">Dominant</option>
	<option value="Master">Master</option>
	<option value="Pet">Pet</option>
	<option value="Kitten">Kitten</option>
	<option value="Pup">Pup</option>
	<option value="Pony">Pony</option>
	<option value="Owner">Owner</option>
	<option value="Domme">Domme</option>
	<option value="Mistress">Mistress</option>
	<option value="Top">Top</option>
	<option value="Bottom">Bottom</option>
	<option value="Princess">Princess</option>
	<option value="Slut">Slut</option>
	<option value="Cuckold">Cuckold</option>
	<option value="Cuckquean">Cuckquean</option>
	<option value="Daddy">Daddy</option>
	<option value="Mommy">Mommy</option>
	<option value="Big">Big</option>
	<option value="Little">Little</option>
	<option value="Brat">Brat</option>
	<option value="Babygirl">Babygirl</option>
	<option value="Babyboy">Babyboy</option>
    </select>
  </div>

  <div class="addrel-init-role">
    and I am their:<br />
    <select name="rel_user_role">
	<option name="null" value="null"> - Select a Role - </option>
	<option value="Submissive">Submissive</option>
	<option value="Slave">Slave</option>
	<option value="Dominant">Dominant</option>
	<option value="Master">Master</option>
	<option value="Pet">Pet</option>
	<option value="Kitten">Kitten</option>
	<option value="Pup">Pup</option>
	<option value="Pony">Pony</option>
	<option value="Owner">Owner</option>
	<option value="Domme">Domme</option>
	<option value="Mistress">Mistress</option>
	<option value="Top">Top</option>
	<option value="Bottom">Bottom</option>
	<option value="Princess">Princess</option>
	<option value="Slut">Slut</option>
	<option value="Cuckold">Cuckold</option>
	<option value="Cuckquean">Cuckquean</option>
	<option value="Daddy">Daddy</option>
	<option value="Mommy">Mommy</option>
	<option value="Big">Big</option>
	<option value="Little">Little</option>
	<option value="Brat">Brat</option>
	<option value="Babygirl">Babygirl</option>
	<option value="Babyboy">Babyboy</option>
    </select>
  </div>
  <input type="submit" value="Send Request">
</div>
</form>

<div class="cur-rel">
  <h1>Current Relationships</h1>
  <div class="dis-rel">
  <?php

  $sql3 = "SELECT * FROM dd_bp_user_relationships 
	   WHERE init_id = 2 AND rel_conf = 1 
	   UNION ALL 
	   SELECT * FROM dd_bp_user_relationships 
	   WHERE targ_id = 2 AND rel_conf = 1";

  $result3 = $conn->query($sql3);

  if ($result3->num_rows > 0) {

    while($row3 = $result3->fetch_assoc()) {
	//$bp_user_id = get_current_user_id()
	$rel_user_id = 2;

	if ($row3["init_id"] == $rel_user_id) {
		$bp_user_id = $row3["init_id"];
		$bp_user_role = $row3["init_role"];
		$bp_friend_id = $row3["targ_id"];
		$bp_friend_role = $row3["targ_role"];

	$sql4 = "SELECT * FROM dd_users WHERE ID = '" . $bp_user_id . "'";

	$result4 = $conn->query($sql4);

		if ($result4->num_rows > 0) {

    			while($row4 = $result4->fetch_assoc()) {

				$bp_rel_name = $row4["display_name"];
				$bp_rel_link = $row4["user_nicename"];

				echo '<div class="currel-row"><p><a href="http://localhost/digidung/members/' . $bp_rel_link . '/" target="_blank">' . $bp_rel_name . '</a> is your ' . $bp_user_role . '.</p></div>';
	
   	  		}

	  	}

	} elseif ($row3["targ_id"] == $rel_user_id) {
		$bp_user_id = $row3["targ_id"];
		$bp_user_role = $row3["targ_role"];
		$bp_friend_id = $row3["init_id"];
		$bp_friend_role = $row3["init_role"];

	$sql4 = "SELECT * FROM dd_users WHERE ID = '" . $bp_user_id . "'";

	$result4 = $conn->query($sql4);

		if ($result4->num_rows > 0) {

    			while($row4 = $result4->fetch_assoc()) {

				$bp_rel_name = $row4["display_name"];
				$bp_rel_link = $row4["user_nicename"];

				echo '<div class="currel-row"><p><a href="http://localhost/digidung/members/' . $bp_rel_link . '/" target="_blank">' . $bp_rel_name . '</a> is your ' . $bp_user_role . '.</p></div>';
	
   	  		}

	  	}

	}

      }

  }

  ?>
  </div>
</div>

<h1>Pending Relationships</h1>
<div class="rel_pend">
<?php
	$sql5 = "SELECT * FROM dd_bp_user_relationships WHERE targ_id = 2 AND rel_conf IS NULL OR rel_conf = ''";

	$result5 = $conn->query($sql5);

		if ($result5->num_rows > 0) {

			while ($row5 = $result5->fetch_assoc()) { 

			global $rel_id;

			$rel_id = $row5["rel_id"];

			$rel_pend_id = $row5["init_id"];

			$rel_pend_role = $row5["init_role"];

			$rel_pend_myrole = $row5["targ_role"];

			$sql6 = "SELECT * FROM dd_users WHERE ID = '" . $rel_pend_id . "'";

			$results6 = $conn->query($sql6);

				if ($results6->num_rows > 0) {

					while ($row6 = $results6->fetch_assoc()) { 

					$rel_pend_name = $row6["display_name"];

					$rel_pend_link = $row6["user_nicename"];

					?>

			<form name="confirm" action="confirmation.php" method="POST" />
				<p><a href="http://localhost/digidung/members/
				<?php echo $rel_pend_link; ?>/" target="_blank">
				<?php echo $rel_pend_name; ?></a> is requesting a relationship with you as your 
				<?php echo $rel_pend_role; ?> and says you are their <?php echo $rel_pend_myrole; ?>.&nbsp;
				<?php $_SESSION["rel_id"] = $row5["rel_id"]; ?>
				
				<input type="submit" name="confirm" value="Accept" />&nbsp;
				<input type="submit" name="confirm" value="Reject" /></p><br />
			</form>

					<?php

					}

				}

			}

		} else {

			echo "<p>Sorry... You don't appear to have any pending relationship requests...<br />
				(Please check back at a later time.)</p>";

		}

?>
</div>


</body>
<?php

$conn->close();

?>
