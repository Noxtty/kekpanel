<?php
ob_start();
include 'core/init.php';
protected_page();

if (empty($_POST) === false) {
	$required_fields = array('current_passwrd','password','password_again');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = "Les champs avec un astérisque* sont obligatoires.";
			break 1;
		}
	}

	if (md5($_POST['current_password']) === $user_data['password']) {
		if (trim($_POST['password']) !== trim($_POST['password_again'])) {
			$errors[] = "Votre nouveau mot de passe ne correspond pas.";
		} else if (strlen($_POST['password']) < 5) {
			$errors[] = "Votre nouveau mot de passe doit contenir entre 5 et 32 caractères.";
		}
	} else {
		$errors[] = "Votre mot de passe actuel est incorrecte.";
	}

}
include 'includes/overall/header.php';
?>

<h1>Changer votre mot de passe</h1>

<?php
if (isset($_GET['success']) === true && empty($_GET ['success']) === true) {
	echo "Votre mot de passe a bien été changé!";
} else {

	if (isset($_GET['force']) === true && empty($_GET ['force']) === true) {
		?>
			<p>Vous devez changer votre mot de passe pour continuer.</p>
		<?php
	}


if (empty($_POST) === false && empty($errors) === true) {
	change_password($session_user_id, $_POST['password']);
	header('Location: changepassword.php?success');
} else if (empty($errors) === false) {
	echo output_errors($errors);
}
?>

<form action="" method="post">
	<ul>
		<li>
			Mot de passe actuel*:<br>
			<input type="password" name="current_password">
		</li>
		<li>
			Nouveau mot de passe*:<br>
			<input type="password" name="password">
		</li>
		<li>
			Confirmation du nouveau mot de passe*:<br>
			<input type="password" name="password_again">
		</li>	
		<li>
			<input type="submit" value="Changer mon mot de passe">
		</li>
	</ul>
</form>


<?php
}
include 'includes/overall/footer.php';
?>
