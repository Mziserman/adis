
<a href="<?php the_permalink(); ?>">
  <?php if($count % 2 == 0){ ?>
  <ul class="grey">
    <?php } else { ?>
    <ul class="white">
      <?php } ?>
      <li><?php the_field('date') ?></li>

      <li><?php the_field('entreprise') ?></li>

      <li><?php the_field('poste') ?></li>

      <li><?php the_field('lieu') ?></li>

      <li><?php the_field('duree') ?> mois</li>

      <li><?php the_field('salaire') ?> euros</li>
    </ul>
    </a>