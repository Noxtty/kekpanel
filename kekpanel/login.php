<?php
ob_start();
include 'core/init.php';
already_logged();


if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (empty($username) === true || empty($password) === true) {
		$errors[] = "Vous devez entrer votre nom d'utilisateur et votre mot de passe.";
	}	else if (user_exists($username) === false) {
		$errors[] = "Ce nom d'utilisateur n'existe pas. Vous devez vous inscrire.";
	} 	else if (user_active($username) === false) {
		$errors[] = "Vous devez activer votre compte.";
	} else {

		if (strlen($password) > 32) {
			$errors[] = "Votre mot de passe est trop long. ";
		}

		$login = login($username, $password);
		if ($login === false) {
			$errors[] = "Ce mot de passe est incorrect.";
		} else {
			
			$_SESSION['user_id'] = $login;
			header('Location: panel.php');
			exit();
		}

		}
	} else {
		$errors[] = 'Aucun résultat trouvé';
	}

	include 'includes/overall/header.php';
	if (empty($errors) === false) {
	?>
		<h2>Il semble avoir une ou plusieurs erreur(s):</h2>
	<?php
		echo output_errors($errors);

	}
	include 'includes/overall/footer.php';
?>