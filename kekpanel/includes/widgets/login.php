	<div class="widget">
		<h2>Se connecter</h2>
		<div class="inner">
			<form action="login.php" method="post">
				<ul id="login">
					<li>
					<input type="text" name="username" value="Nom d'utilisateur" onfocus="inputFocus(this)" onblur="inputBlur(this)" />
					</li>
					<li>
					<input type="password" name="password" value="Mot de passe" onfocus="inputFocus(this)" onblur="inputBlur(this)">
					</li>
					<input type="submit" value="Se connecter">
					</li>
					<li>
						<a href="register.php">S'enregistrer</a>
					</li>
					<li>
						<a href="recover.php?mode=username">Nom d'utilisateur</a> ou <a href="recover.php?mode=password">mot de passe</a> oublié?
					</li>
				</ul>
			</form>
		</div>
	</div>
