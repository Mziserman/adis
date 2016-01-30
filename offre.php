
<a href="<?php the_permalink(); ?>">
	<div>
		<?php the_field('date') ?>

		<?php the_field('entreprise') ?>

		<?php the_field('poste') ?>

		<?php the_field('lieu') ?>

		<?php the_field('duree') ?> mois

		<?php the_field('salaire') ?> euros
	</div>
</a>