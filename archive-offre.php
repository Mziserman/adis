<?php get_header(); ?>

<div id="main">
	<div id="content">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part('offre'); ?>
		<?php endwhile; else: ?>
			<?php get_template_part('no_content'); ?>
		<?php endif; ?>

	</div>
	<?php get_sidebar(); ?>
</div>
<div id="delimiter"></div>

<?php get_footer(); ?>