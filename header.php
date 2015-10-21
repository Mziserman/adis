<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <title><?php wp_title(); ?></title>
        <?php wp_head(); ?>
    </head>
    <body <?php body_class(is_home() ? array('nice') : array('notNice')) ?>>
    	<?php wp_nav_menu(array('theme_location'=>'primary')) ?>