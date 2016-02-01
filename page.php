<?php get_header(); ?>

<?php get_template_part('index'); ?>

<?php if(have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="container">
  
  <div class="content-page">
    
    <?php echo $post->post_content; ?>
    
  </div>
  
</div>

<?php endwhile; endif; ?>

<?php get_footer(); ?>