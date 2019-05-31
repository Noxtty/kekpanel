<?php
include 'core/init.php';
already_logged();
include 'includes/overall/header.php';
?>

<h1>Incapable de vous connecter?</h1>

<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
?>
	<p>Merci, un courriel vous a été envoyé. Vérifier dans votre boite de courriels indésirables.</p>
<?php
} else {
	$mode_allowed = array('username', 'password');
	if (isset($_GET['mode']) === true && in_array($_GET['mode'], $mode_allowed) === true) {
		if (isset($_POST['email']) === true && empty ($_POST['email']) === false) {
			if (email_exists($_POST['email']) === true) {
				recover($_GET['mode'], $_POST['email']);
				header('Location: recover.php?success');
			} else {
				echo "<p>Cette adresse courriel est invalide.</p>";
			}
		}
	?>

		<form action="" method="post">
			<ul>
				<li>
					Veuillez entrer votre adresse courriel:<br>
					<input type="text" name="email">
				</li>
				<li><input type="submit" value="Prochaine étape"></li>
			</ul>
		</form>


	<?php
	} else {
		header('Location: panel.php');
		exit();
	}
}
?>


<?php include 'includes/overall/footer.php' ?>
