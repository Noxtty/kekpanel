<?php 
ob_start();
include 'core/init.php';
already_logged();
include 'includes/overall/header.php';

if (empty($_POST) === false) {
	$required_fields = array('username','password','password_again','email','first_name');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = "Les champs avec un astérisque* sont obligatoires.";
			break 1;
		}
	}

	if (empty($errors) === true) {
		if (user_exists($_POST['username']) === true) {
			$errors[] = "Ce nom d'utilisateur est déjà utilisé.";
		} 
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = "Votre nom d'utilisateur ne doit pas contenir d'espace.";

		}
		if (strlen($_POST['password']) < 5) {
			$errors[] = "Votre mot de passe doit contenir entre 5 et 32 caractères.";
		}
		if (strlen($_POST['username']) < 3) {
			$errors[] = "Votre nom d'utilisateur doit contenir entre 3 et 32 charactères.";
		}
		if ($_POST['password'] !== $_POST['password_again']) {
			$errors[] = "Votre mot de passe ne correspond pas.";
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = "L'adresse courriel doit être valide.";
		}
		if (email_exists($_POST['email']) === true) {
			$errors[] = "Cette adresse courriel est déjà utilisée.";
		}
	}
}

?>

<h1>S'enregistrer</h1>

<?php
if (isset($_GET['success']) && empty($_GET ['success'])) {
?>
<p>
Vous avez été enregistré avec succès! Veuillez regarder vos courriel pour activer votre compte. <br>(Vérifier dans la boite de courriers non désirés.)
</p>
<?php	
} else 	{

		if (empty($_POST) === false && empty($errors) === true) {
			// registered user
			$register_data = array(
				'username'	=> $_POST['username'],
				'password'	=> $_POST['password'],
				'first_name'	=> $_POST['first_name'],
				'last_name'	=> $_POST['last_name'],
				'email'	=> $_POST['email'],
				'email_code'	=> md5($_POST['username'] + microtime())
				);
			register_user($register_data);
			//redirect
			header('Location: register.php?success');
			//exit
			exit();

		} else if (empty($errors) === false) {
			//output errors
			echo output_errors($errors);
	}
?>

	<form action="" method="post">
		<ul>
			<li>
				Nom d'utilisateur<span class="asterix">*</span>:<br>
				<input type="text" name="username" onfocus="inputFocus(this)" onblur="inputBlur(this)">
			</li>
			<li>
				Mot de passe<span class="asterix">*</span>:<br>
				<input type="password" name="password" onfocus="inputFocus(this)" onblur="inputBlur(this)">
			</li>
			<li>
				Confirmation du mot de passe<span class="asterix">*</span>:<br>
				<input type="password" name="password_again" onfocus="inputFocus(this)" onblur="inputBlur(this)">
			</li>
			<li>
				Prénom<span class="asterix">*</span>:<br>
				<input type="text" name="first_name" onfocus="inputFocus(this)" onblur="inputBlur(this)">
			</li>
			<li>
				Nom:<br>
				<input type="text" name="last_name" onfocus="inputFocus(this)" onblur="inputBlur(this)">
			</li>
			<li>
				Adresse courriel<span class="asterix">*</span>:<br>
				<input type="text" name="email" value="exemple@courriel.com" onfocus="inputFocus(this)" onblur="inputBlur(this)">
			</li>
			<li>
				<input type="submit" value="S'enregistrer">
			</li>
		</ul>
	</form>

<?php
}
include 'includes/overall/footer.php'; ?>