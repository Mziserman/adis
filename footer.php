<footer>
  
	<?php 
	if(is_user_logged_in()){
		echo '<a href="' . get_site_url() . '/etudiant/' . get_current_user_id() .'">Accès au profil</a>';
		echo '<a href="' . wp_logout_url( site_url( '/' ) ) .'">Se déconnecter</a>';
	}

	?>

</footer>
</body>
</html>