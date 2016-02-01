<?php acf_form_head(); ?>
<?php get_header(); ?>

<?php

if(is_user_logged_in()){

  $user_id = get_current_user_id();
  $post_id = $post->post_content_filtered;

  if($user_id == $post_id)
    acf_form_head();

?>

<div class="container">

  <div class="etudiant">
    <div class="pic">
      <?php if(get_field('photo')){ ?>
      <img src="<?php the_field('photo') ?>" alt="">
      <?php } else { ?>
      <img src="<?php echo get_template_directory_uri(); ?>/assets/no_pic.png" alt="">
      <?php } ?>
    </div>

    <div class="info">
      <div class="name">
        <?php the_field('nom') ?>
        <?php the_field('prenom') ?>
      </div>

      <div class="promo">
        <?php the_field('promotion') ?>
      </div>

      <div class="diplome">
        Diplome : <br>
        <?php if( have_rows('diplomes') ):

  // loop through the rows of data
  while ( have_rows('diplomes') ) : the_row();
        ?>

        <p>- <?php the_sub_field('diplome') ?></p>

        <?php endwhile; endif; ?>
      </div>
    </div>
  </div>

  <div class="online">
    <div>
      Mail : <?php the_field('mail') ?>
    </div>

    <?php if(get_field('twitter') != '' || get_field('linkedin') != '') { ?>
    <div class="reseaux">
      <p>Réseaux sociaux : </p>
      <?php 
          if(get_field('twitter')){
      ?>

      <a href="<?php the_field('twitter') ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/twitter.png" alt=""></a>

      <?php

          }

          if(get_field('linkedin')){
      ?>

      <a href="<?php the_field('linkedin') ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/linkedin.png" alt=""></a>

      <?php

          } ?>

    </div>

    <?php  } ?>
  </div>

  <div class="bio">

    <?php if(get_field('poste_actuel') == 'Oui'): ?>
    <div class="actual">
      <div class="label">Poste actuel :</div>
      Chez <span><?php the_field('entreprise_actuel') ?></span> depuis <span><?php the_field('date_actuel') ?></span><br>
      Poste: <span><?php the_field('mission_actuel') ?></span>
    </div>
    <?php endif; ?>

    <?php if( have_rows('emploies_precedents') ): ?>

    <div>
      <div class="label">Poste précédents :</div>

      <?php
  // loop through the rows of data
  while ( have_rows('emploies_precedents') ) : the_row();
      ?>
      <div class="job">
        Chez <span><?php the_sub_field('entreprise') ?></span> du <span><?php the_sub_field('date_de_debut') ?></span> au <span><?php the_sub_field('date_fin') ?></span><br>
        Poste: <span><?php the_sub_field('poste_occupee') ?></span>
      </div>

      <?php endwhile;?> 
    </div>
    <?php endif; ?>

  </div>

  <div class="update">

    <?php if($user_id == $post_id){ ?>

    <div class="button">
      <button>Modifier mon profil</button>
    </div>

    <?php acf_form(); ?>

    <?php } ?>

  </div>

</div>

<?php } else { ?>
<div class="container">
  <div class="error">
    Vous devez être connecté pour acceder à ce contenue
  </div>
</div>
<?php } ?>

<?php get_footer(); ?>
