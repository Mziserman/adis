<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <?php 

    $id = wp_get_current_user()->ID;

    checkProfil($id); ?>

    <header class="header_container">
      <div class="header_wrapper">
        <a href="<?php echo get_site_url(); ?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/assets/LOGO.png" alt="ADIS"></a>
        <?php wp_nav_menu(); ?>
        <ul class="menu_right">
          <?php if( ! is_user_logged_in()){ ?>
          <li class="menu_item connexion">
            <a href="#">connexion</a>
          </li>
          <?php } else { ?>
          <li class="menu_item user">
            <div class="user_pofile">
             <a href="<?php echo get_site_url() . '/etudiant/' . get_current_user_id() ?>">Profil <?php echo wp_get_current_user()->user_nicename ?></a>
            </div>
            <div class="user_leave">
              <a href="<?php echo wp_logout_url( site_url( '/' ) ) ?>">Se déconnecter</a>
            </div>
          </li>
          <?php } ?>
          <li class="menu_item">
            <a href="<?php echo get_site_url() . '/depose/' ?>">Poster une offre de stage/emploi</a>
          </li>
        </ul>
      </div>
    </header>