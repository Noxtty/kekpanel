			<?php
			$user_count = user_count();
			$suffix = ($user_count != 1) ? 's' : '';
			?>
	<div class="widget">
		<h2>Utilisateur<?php echo $suffix; ?></h2>
		<div class="inner">
			Nous avons présentement <?php echo $user_count; ?> utilisateur<?php echo $suffix; ?> enregistré<?php echo $suffix; ?>.
		</div>
	</div>
