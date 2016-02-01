<a href="<?php the_permalink(); ?>">
  <?php if($count % 2 == 0){ ?>
  <ul class="grey">
    <?php } else { ?>
    <ul class="white">
      <?php } ?>
      <li><?php the_field('nom') ?></li>
      <li><?php the_field('prenom') ?></li>
      <li>
        <?php if( have_rows('diplomes') ):

        // loop through the rows of data
        while ( have_rows('diplomes') ) : the_row();
        ?>

        <?php the_sub_field('diplome') ?>

        <?php endwhile; endif; ?>
      </li>
      <li><?php the_field('lieu') ?></li>
      <li><?php the_field('promotion') ?></li>
    </ul>
    </a>