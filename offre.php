<div class="thumbnail-img"><?php the_post_thumbnail() ?></div>
<?php $post_id = get_the_ID() ?>
<h1><?php the_title(); ?></h1>
<small>Posted on: <?php the_time('F j, Y'); ?> at <?php the_time('g:i a'); ?></small>
<p><?php the_content(); ?></p>
<?php 
	$field = get_fields($post_id); 
	echo '<pre>';
	print_r($field);
	echo '</pre>';
?>

<hr>