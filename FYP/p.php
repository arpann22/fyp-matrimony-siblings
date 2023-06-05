<?php
session_start();
require_once('db_connect.php');
$user = $_SESSION['user'];
$search = $_POST['search'];
if (!empty($search)) {


	$curr_user_father = mysqli_query($con, "SELECT father_name FROM biodata bd WHERE  bd.user = '{$user}' ;");
	foreach ($curr_user_father as $curr_user_fathers) {
		$curr_user_father = $curr_user_fathers["father_name"];

	}

	$query = "SELECT tp.mail as mail, tp.id as id, tp.name as name
				FROM tipshoi tp, biodata bd 
				WHERE tp.mail = bd.user AND tp.mail != '{$user}' AND bd.father_name != '$curr_user_father' AND tp.name LIKE '$search%' ORDER BY tp.id DESC;";

	// die($query);
	// $query = "SELECT * FROM tipshoi WHERE name LIKE '$search%';";
	$run = mysqli_query($con, $query);
	while ($row = mysqli_fetch_array($run)) {
		$name = $row['name'];
		$us_id = $row['id'];
		$mail = $row['mail'];
		if ($mail != $user && $mail != "admin@admin.com") {
			?>

			<a style="text-decoration: none;" href="profile.php?us1031gdh312k=<?php echo $us_id; ?>">
				<h5 style="color: #662e91;">
					<?php echo $name ?>
				</h5>
			</a>



			<?php
		}
	}
}


?>