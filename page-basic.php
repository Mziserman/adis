<?php 

get_header(); 

/*
	Template Name: Basic
*/
?>

<div id="main">
	<div id="content">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<h1><?php the_title(); ?></h1>
		<p><?php the_content(); ?></p>
		<p>caca</p>
		<hr><?php endwhile; else: ?>
		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p><?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<div id="delimiter"></div>
<?php
	// Formulaire de connexion
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
	} else {
		echo '<a href="' . admin_url( 'user-edit.php?user_id='. get_current_user_id() ) .'">Accès au profil</a><br/>';
		echo '<a href="' . wp_logout_url( site_url( '/' ) ) .'">Se déconnecter</a>';
	}
?>
<?php get_footer(); ?>