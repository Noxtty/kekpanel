	<div class="widget">
		<h2>Allo, <?php echo $user_data['first_name'];?>!</h2>
		<div class="inner">
			<ul>
				<li>
				<a href="logout.php">Déconnexion</a>
				</li>
				<li>
					<a href="changepassword.php">Changer de mot de passe</a>
				</li>
				<li>
					<a href="user_settings.php">Profil</a>
				</li>
				<li>
					<a href="<?php echo $user_data['username'];?>"><?php echo $user_data['username'];?></a>
				</li>
				<?php 
					if (has_access($session_user_id, 1) === true) {
						include 'includes/widgets/loggedin_admin.php';
					} else if (has_access($session_user_id, 2) === true){
						include 'includes/widgets/loggedin_moderator.php';
					}
				?>
			</ul>
		</div>
	</div>
