<?php
ob_start();
include 'core/init.php';
protected_page();
include 'includes/overall/header.php';

if (empty($_POST) === false) {
	$required_fields = array('first_name', 'email');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = "Les champs avec un astérisque* sont obligatoires.";
			break 1;
		}
	}
	
	if (empty($errors) === true) {
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$errors[] = "L'adresse courriel doit être valide.";
		} else if (email_exists($_POST['email']) === true && $user_data['email'] !== $_POST['email']) {
			$errors[] = "Cette adresse courriel est déjà utilisée.";
		}
	}
	
}
?>
<h1>Votre profil</h1>
<?php
if (isset($_GET['success']) === true && empty($_GET['success']) === true) {
	echo "Votre profil à été sauvegarder!";
}	else {

	if (empty($_POST) === false && empty($errors) === true) {
		$update_data = array(
			'first_name' 	=> $_POST['first_name'],
			'last_name'	 => $_POST['last_name'],
			'email' 	=> $_POST['email'],
			
		);
		
	update_user($session_user_id, $update_data);
	header('Location: user_settings.php?success');
	exit();
		
	} else if (empty($errors) === false) {
		echo output_errors($errors);
	}
?>

<form action="" method="POST">
	<ul>
    	<li>
        	Prénom*:<br>
            <input type="text" name="first_name" value="<?php echo $user_data['first_name'];?>" onfocus="inputFocus(this)" onblur="inputBlur(this)">
        </li>
        <li>
        	Nom:<br>
            <input type="text" name="last_name" value="<?php echo $user_data['last_name'];?>" onfocus="inputFocus(this)" onblur="inputBlur(this)">
        </li>
        <li>
        	Adresse courriel*:<br>
            <input type="text" name="email" value="<?php echo $user_data['email'];?>" onfocus="inputFocus(this)" onblur="inputBlur(this)">
        </li>
        <li>
        	<input type="submit" value="Sauvegarder">
        </li>
    </ul>
</form>

<?php
}
include 'includes/overall/footer.php';
?>
