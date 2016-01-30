<!DOCTYPE html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<title><?php wp_title(); ?></title>
		<?php wp_head(); ?>
	</head>
	<body>
		  <?php 

		  $id = wp_get_current_user()->ID;
                
		  checkProfil($id);
    
		  wp_nav_menu(); ?>
