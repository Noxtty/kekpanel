	<nav>
		<ul>
			<li><a href="panel.php">Accueil</a></li>
			<?php
			if (logged_in() === true) {
			include'includes/protected_menu.php';
			}
			?>
			<li><a href="contact.php">Contactez-moi</a></li>
		</ul>
	</nav>
