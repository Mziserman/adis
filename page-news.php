<?php get_header(); ?>

<?php get_template_part('index'); ?>

<div class="container">

  <div class="news">
    <?php 
    $args = array(
      'post_type' => 'news',
      'post_status' => 'publish',
      'posts_per_page' => -1,
      'caller_get_posts'=> 1
    );

    $my_query = new WP_Query($args);

    foreach($my_query->posts as $post)
    {

      $post_author = get_user_by('id', $post->post_author);
      $date = date("d/m/Y", strtotime(substr($post->post_date, 0, 10)));

    ?>
    <div class="article">
      <div class="info">
        <div class="author"><?php echo $post_author->user_nicename ?></div>
        <div class="date">
          <?php echo $date ?>
        </div>
      </div>
      <h1><?php echo $post->post_title; ?></h1>
      <div class="content">
        <?php echo $post->post_content ?>
      </div>
    </div>

    <?php

    }  
    ?>
  </div>

  <div class="sociaux">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/LOGO.png" alt=""> sur les réseaux sociaux
    <div class="trait"></div>

    <div class="logos">
      <a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/twitter.png" alt=""></a>
      <a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/facebook.png" alt=""></a>
      <a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/linkedin.png" alt=""></a>
      <a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/vimeo.png" alt=""></a>
    </div>

  </div>

</div>

<?php get_footer(); ?>