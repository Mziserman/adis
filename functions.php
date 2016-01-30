<?php
function adisScriptEnqueue() {

  wp_enqueue_style('customstyle', get_template_directory_uri() . '/css/adis.css', array(), '1.0.0', 'all');
  wp_enqueue_script('customjs', get_template_directory_uri() . '/js/adis.js', array(), '1.0.0', true);

}
add_action('wp_enqueue_scripts', 'adisScriptEnqueue');

function my_enqueue_scripts() {
  wp_enqueue_script('script');
  wp_localize_script( 'script', 'ajaxurl', array(
    'ajaxurl'       => admin_url( 'admin-ajax.php' ),
  ));
}
add_action('wp_enqueue_scripts','my_enqueue_scripts');


add_filter( 'login_form_bottom', 'lostPasswordUrl' );
function lostPasswordUrl( $formbottom ) {
  $formbottom .= '<a href="' . wp_lostpassword_url() . '">Mot de passe perdu ?</a>';
  return $formbottom;
}
function adisThemeSupport(){
  add_theme_support('menus');

  register_nav_menu('primary', 'primary header navigation');
  register_nav_menu('secondary', 'footer navigation');
}
add_action('init', 'adisThemeSupport');

add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array('aside', 'image', 'video'));

add_action('init', 'create_post_type');

add_post_type_support( 'offre', 'post-formats' );
add_post_type_support( 'etudiant', 'post-formats' );

if ( ! wp_next_scheduled( 'date_offre' ) ) {
  wp_schedule_event( time(), 'daily', 'date_offre' );
}

add_action( 'date_offre', 'delete_offre_date' );

function delete_offre_date() {

  $args = array(
    'numberposts'	=> -1,
    'post_type'		=> 'offre',
  );

  $the_query = new WP_Query( $args );

  if( $the_query->have_posts() ){
    while( $the_query->have_posts() ) {
      $the_query->the_post();

      $post_date = get_field('date');

      $day    = substr($post_date, 0, 2);
      $mounth = substr($post_date, 3, 2);
      $year   = substr($post_date, 6, 4);

      $post_timestamp = strtotime($day.'-'.$mounth.'-'.$year);

      $now = time();

      if($post_timestamp < $now)
        wp_delete_post(get_the_ID());

    }
  }
}

function create_post_type() {

  register_post_type( 'etudiant',
                     array(
                       'labels' => array(
                         'name' => __('Étudiants'),
                         'singular_name' => __('Étudiant')
                       ),
                       'public' => true,
                       'supports' => array('title', 'editor', 'thumbnail'),
                       'has_archive' => true
                     )
                    );

  register_post_type( 'offre',
                     array(
                       'labels' => array(
                         'name' => __('Offres'),
                         'singular_name' => __('Offre')
                       ),
                       'public' => true,
                       'supports' => array('title', 'editor', 'thumbnail'),
                       'has_archive' => true
                     )
                    );

  register_taxonomy(  
    'contrat', 
    'offre', 
    array(
      'label' => __('Type de contrat'),
      'hierarchical' => true,
    )
  );

  register_taxonomy(  
    'lieu', 
    'offre', 
    array(
      'label' => __('Lieu de déroulement'),
      'hierarchical' => true,
    )
  );

  register_taxonomy(  
    'entreprise', 
    'offre', 
    array(
      'label' => __('Entreprise'),
      'hierarchical' => true,
    )
  );
  register_taxonomy(  
    'poste', 
    'offre', 
    array(
      'label' => __('Poste proposé'),
      'hierarchical' => true,
    )
  );
  register_taxonomy(  
    'duree', 
    'offre', 
    array(
      'label' => __('Duree du contrat'),
      'hierarchical' => true,
    )
  );

}

add_action( 'wp_ajax_formulaire', 'formulaire' );
add_action( 'wp_ajax_nopriv_formulaire', 'formulaire' );

function formulaire(){

  if(!empty($_POST['date']) && !empty($_POST['contrat']) && !empty($_POST['poste']) && !empty($_POST['entreprise']) && !empty($_POST['lieu']) && !empty($_POST['duree']) && !empty($_POST['salaire']) && !empty($_POST['description']) && !empty($_POST['mail'])){

    $insertPost = array(

      'post_title' 	=> $_POST['entreprise']. ' => ' . $_POST['poste'],
      'post_type'  	=> 'offre',

    );

    $customPostId = wp_insert_post($insertPost);
    update_field("field_56a3ff884cbf7", $_POST['date'], $customPostId);
    update_field("field_56a413f9f99af", $_POST['contrat'], $customPostId);
    update_field("field_56a3fffa4cbf8", $_POST['poste'], $customPostId);
    update_field("field_56a400424cbf9", $_POST['entreprise'], $customPostId);
    update_field("field_56a4005a4cbfa", $_POST['lieu'], $customPostId);
    update_field("field_56a400a64cbfb", $_POST['duree'], $customPostId);
    update_field("field_56a400d94cbfc", $_POST['salaire'], $customPostId);
    update_field("field_56a40f36fc9f1", $_POST['description'], $customPostId);
    update_field("field_56a40f86fc9f2", $_POST['contact'], $customPostId);
    wp_set_object_terms($customPostId, $_POST['poste'], 'poste');
    wp_set_object_terms($customPostId, $_POST['entreprise'], 'entreprise');
    wp_set_object_terms($customPostId, $_POST['lieu'], 'lieu');

    echo 'Offre enregistré';

  } else {

    echo 'Un champs doit etre vide';

  } 

  die();

}

function checkProfil($id){

  $type = 'etudiant';
  $args = array(
    'post_type' => $type,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'caller_get_posts'=> 1
  );

  $my_query = new WP_Query($args);

  $already_exist = 0;

  foreach($my_query->posts as $post)
  {

    if($post->post_content_filtered == $id){
      $already_exist = 1;
    }

  } 

  if($already_exist == 0){

    $arg = array(
      'post_type'             => 'etudiant',
      'post_status'           => 'publish',
      'post_title'            => $id,
      'post_content_filtered' => $id
    );

    wp_insert_post($arg);

  }

}