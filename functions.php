<?php
function adisScriptEnqueue() {

	wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/adis.css', array(), '1.0.0', 'all');
	wp_enqueue_script('customjs', get_template_directory_uri() . '/js/adis.js', array(), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'adisScriptEnqueue');

add_filter( 'login_form_bottom', 'lostPasswordUrl' );
function lostPasswordUrl( $formbottom ) {
	$formbottom .= '<a href="' . wp_lostpassword_url() . '">Mot de passe perdu ?</a>';
	return $formbottom;
}
function adisThemeSupport(){
	add_theme_support('menus');

	register_nav_menu('primary', 'primary header navigation');
	register_nav_menu('secondary', 'footer navigation');
}
add_action('init', 'adisThemeSupport');

add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('aside', 'image', 'video'));

add_action('init', 'create_post_type');

add_post_type_support( 'offre', 'post-formats' );

function create_post_type() {
	register_post_type( 'offre',
		array(
			'labels' => array(
				'name' => __('Offres'),
				'singular_name' => __('Offre')
			),
			'public' => true,
			'supports' => array('title', 'editor', 'thumbnail'),
			'has_archive' => true
		)
	);
	register_post_type( 'contrat',
		array(
			'labels' => array(
				'name' => __('Contrats'),
				'singular_name' => __('Contrat')
			),
			'public' => true,
			'supports' => array('title'),
			'has_archive' => true
		)
	);



}

