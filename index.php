<div class="popconnexion">
<div class="quit">X</div>
<?php
//	 Formulaire de connexion
	if ( ! is_user_logged_in() ) {
		wp_login_form( array(
	        'redirect'       => site_url( '/' ), // par défaut renvoie vers la page courante
	        'label_username' => 'Login',
	        'label_password' => 'Mot de passe',
	        'label_remember' => 'Se souvenir de moi',
	        'label_log_in'   => 'Se connecter',
	        'form_id'        => 'login-form',
	        'id_username'    => 'user-login',
	        'id_password'    => 'user-pass',
	        'id_remember'    => 'rememberme',
	        'id_submit'      => 'wp-submit',
	        'remember'       => true, //afficher l'option se ouvenir de moi
	        'value_remember' => false //se souvenir par défaut ?
			
		) );
		
	}
?>
</div>