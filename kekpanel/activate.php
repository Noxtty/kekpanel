<?php 
ob_start();
include 'core/init.php';
already_logged();
include 'includes/overall/header.php';

if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<h2>Merci, nous avons activé votre compte...</h2>
	<p>Vous pouvez maintenant vous connecter.</p>
<?php
} else if (isset($_GET['email'], $_GET['email_code']) === true) {


	$email = trim($_GET['email']); 
	$email_code = trim($_GET['email_code']);

	if (email_exists($email) ===  false) {
		$errors[] = "Oups! Il semble avoir un erreur, veuillez réessayer plus tard.";
	} else if (activate($email, $email_code) ===  false) {
		$errors[] = "Nous avons un problème à activer votre compte.";
	}

	if (empty($errors) === false) {
	?>
		<h2> Oups...</h2>
	<?php
		echo output_errors($errors);
	} else {
		header('Location: activate.php?success');
		exit();
	}

} else {
	header('Location: panel.php');
	exit();
}

include 'includes/overall/footer.php';
?>