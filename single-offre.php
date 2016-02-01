<?php get_header(); ?>

<div class="container">
  <?php if(is_user_logged_in()){ ?>

  <div class="offre">

    <div>
      <span class="left">Employeur : </span>
      <span class="right"><?php the_field('entreprise'); ?></span>
    </div>

    <div>
      <span class="left">Type de contrat proposé : </span>
      <span class="right"><?php the_field('type_de_contrat'); ?></span>
    </div>

    <div>
      <span class="left">Date de début de la mission : </span>
      <span class="right"><?php the_field('date'); ?></span>
    </div>

    <div>
      <span class="left">Poste proposé : </span>
      <span class="right"><?php the_field('poste'); ?></span>
    </div>

    <div>
      <span class="left">Lieu du poste : </span>
      <span class="right"><?php the_field('lieu'); ?></span>
    </div>

    <div>
      <span class="left">Durée de la mission : </span>
      <span class="right"><?php the_field('duree'); ?></span>
    </div>

    <div>
      <span class="left">Rémuniration au mois : </span>
      <span class="right"><?php the_field('salaire'); ?> euros</span>
    </div>

    <div class="desc">
      <span class="left">Description de la mission : </span><br>
      <span class="right"><?php the_field('description'); ?></span>
    </div>

    <div class="contact">
      <span class="left">Contact pour postuler : </span>
      <span class="right"><?php the_field('contact'); ?></span>
    </div>

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