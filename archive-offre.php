<?php get_header(); ?>

<?php 

if(is_user_logged_in()){

$contrat 	= $_GET['contrat'];
$poste 		= $_GET['poste'];
$entreprise = $_GET['entreprise'];
$lieu    	= $_GET['lieu'];
$duree   	= $_GET['duree'];
$salaire 	= $_GET['salaire'];

$filter = array($contrat, $poste, $entreprise, $lieu, $duree, $salaire);
?>

<form method="get">

  <div>
    <?php 
    $termsContrat = get_terms( 'contrat', 'orderby=id&hide_empty=0' );
    ?>
    <span>Type :</span>
    <select name="contrat">
      <option value="">Tous</option>
      <?php	foreach($termsContrat as $term ) :	?>

      <?php if($filter[0] == $term->slug) { ?>
      <option value="<?php echo $term->slug ?>" selected><?php echo $term->name ?></option>
      <?php } else { ?>
      <option value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
      <?php } ?>

      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <?php 
    $terms = get_terms( 'poste', 'orderby=id&hide_empty=0' );
    ?>
    <span>Poste :</span>
    <select name="poste" id="">
      <option value="">Tous</option>
      <?php	foreach($terms as $term ) :	?>

      <?php if($filter[1] == $term->slug) { ?>
      <option value="<?php echo $term->slug ?>" selected><?php echo $term->name ?></option>
      <?php } else { ?>
      <option value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
      <?php } ?>

      <?php endforeach; ?>

    </select>
  </div>

  <div>
    <span>Entreprise :</span>
    <?php $EntrepriseTerms = get_terms('entreprise', 'orderby=id&hide_empty=0'); ?>
    <select name="entreprise" id="">
      <option value="">Toutes</option>
      <?php foreach($EntrepriseTerms as $term) : ?>

      <?php if($filter[2] == $term->slug) { ?>
      <option value="<?php echo $term->slug ?>" selected><?php echo $term->name ?></option>
      <?php } else { ?>
      <option value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
      <?php } ?>

      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <span>Lieu :</span>
    <?php $PlaceTerms = get_terms('lieu', 'orderby=id&hide_empty=0'); ?>
    <select name="lieu" id="">
      <option value="">Tous</option>
      <?php foreach($PlaceTerms as $term) : ?>

      <?php if($filter[3] == $term->slug){ ?>
      <option value="<?php echo $term->slug ?>" selected><?php echo $term->name ?></option>
      <?php } else { ?>
      <option value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
      <?php } ?>

      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <?php $DureeTerms = get_terms('duree', 'orderby=id&hide_empty=0'); ?>
    <span>Durée :</span>
    <select name="duree" id="">
      <option value="">Tous</option>
      <?php foreach($DureeTerms as $term) : ?>

      <?php if($filter[4] == $term->slug){ ?>
      <option value="<?php echo $term->slug ?>" selected><?php echo $term->name ?></option>
      <?php } else { ?>
      <option value="<?php echo $term->slug ?>"><?php echo $term->name ?></option>
      <?php } ?>

      <?php endforeach; ?>
    </select>
  </div>

  <div>
    <label for="salaire">Salaire supérieur à :</label>
    <input type="text" name="salaire" value="<?php if($filter[5] != NULL) echo $filter[5] ?>">						
  </div>

  <div>
    <input type="submit" value="RECHERCHER">
  </div>

</form>

<div id="main">
  <div id="content">

    <div>Listes des offres</div>

    <?php

  $type = 'offre';
           $args = array(
             'post_type' => $type,
             'post_status' => 'publish',
             'posts_per_page' => -1,
             'caller_get_posts'=> 1
           );

           $my_query = new WP_Query($args);

           foreach($my_query->posts as $post){

             $Pcontrat 	  = get_field('type_de_contrat');
             $Pposte 		  = get_field('poste');
             $Pentreprise = get_field('entreprise');
             $Plieu    	  = get_field('lieu');
             $Pduree   	  = get_field('duree');
             $Psalaire 	  = get_field('salaire');

             $tags = array($Pcontrat, $Pposte, $Pentreprise, $Plieu, $Pduree, $Psalaire);

             $filt = 0;
             $match = 0;

             for($i = 0; $i < 6; $i++){

               if($filter[$i] != NULL){

                 $filt++;

                 if($i < 4){
                   if(strcasecmp($filter[$i], $tags[$i]) == 0){
                     $match++;
                   }
                 }
                 else if($i == 4){

                   $str = $filter[4];
                   preg_match_all('!\d+!', $str, $matches); 

                   if($tags[4] <= $matches[0][0])
                     $match++;
                 }
                 else if($i == 5){

                   if($filter[5] <= $tags[5])
                     $match++;

                 }
               }

             }

             if($match == $filt)
               get_template_part('offre');

           }

    ?>


  </div>

</div>
<div id="delimiter"></div>

<?php 

} else{
  
  echo 'NON';
  
}
?>

<?php get_footer(); ?>