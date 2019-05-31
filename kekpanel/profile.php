<?php
include 'core/init.php';
include 'includes/overall/header.php';

if (isset($_GET['username']) === true && empty($_GET['username']) === false) {
	$username = $_GET['username'];

	if(user_exists($username) === true) {

		$user_id = user_id_from_username($username);
		$profile_data = user_data($user_id, 'username', 'first_name', 'last_name', 'email');

		?>

			<h1><?php echo $profile_data['username']; ?></h1>
			<p><?php echo $profile_data['first_name']; ?><br>
			<?php echo $profile_data['last_name']; ?><br>
			<?php echo $profile_data['email']; ?></p>


		<?php

	} else {
		echo "Cet utilisateur n'existe pas.";
	}
} else {
	header('Location: panel.php');
	exit();
}

include 'includes/overall/footer.php'; ?>
