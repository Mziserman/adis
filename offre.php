<div class="thumbnail-img"><?php the_post_thumbnail() ?></div>
<?php $post_id = get_the_ID() ?>
<h1>Intitulé du poste : <?php the_title(); ?></h1>
<small>Posté le <?php the_time('j F Y'); ?> à <?php the_time('g:i a'); ?></small>
<p>Description du poste : <?php the_content(); ?></p>
<?php 
	$field = get_fields($post_id); 
	echo '<pre>';
	print_r($field);
	echo '</pre>';
?>

<hr>