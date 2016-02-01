<?php get_header(); ?>
<?php get_template_part('index'); ?>

<?php 

if(is_user_logged_in()){

  $nom     	 = strtoupper($_GET['nom']);
  $promotion = strtoupper($_GET['promo']);
  $diplome   = strtoupper($_GET['diplome']);
  $lieu    	 = strtoupper($_GET['place']);

  $filter = array($nom, $promotion, $diplome, $lieu);
?>
<div class="container">
  <div class="filters">

    <h2>RECHERCHER UN ÉTUDIANT</h2>

    <form method="get">

      <div>
        <label for="nom">Nom, prénom :</label>
        <input type="text" name="nom" value="<?php if($_GET['nom'] != NULL) echo $_GET['nom'] ?>">
      </div>

      <div>
        <label for="diplome">Diplome :</label>
        <input type="text" name="diplome" value="<?php if($_GET['diplome'] != NULL) echo $_GET['diplome'] ?>">
      </div>

      <div>
        <label for="lieu">Lieu :</label>
        <input type="text" name="place" value="<?php if($_GET['place'] != NULL) echo $_GET['place'] ?>">
      </div>

      <div>
        <label for="promo">Promotion :</label>
        <input type="text" name="promo" value="<?php if($_GET['promo'] != NULL) echo $_GET['promo'] ?>">
      </div>

      <div class="submit">
        <input type="submit" value="RECHERCHER">
      </div>

    </form>
  </div>

  <div class="results">

    <h2>LISTE DES ÉTUDIANTS</h2>

    <ul class="list-header">
      <li>Nom</li>
      <li>Prénom</li>
      <li>Diplome</li>
      <li>Lieu</li>
      <li>Promotion</li>
    </ul>


    <?php 
    $count = 0;

  while(have_posts()) : the_post(); 

  $count++;

  $Pnom 	     = strtoupper(get_field('prenom') . get_field('nom'));
  $Ppromotion  = strtoupper(get_field('promotion'));
  $Pdiplome    = get_field('diplomes');
  $Plieu    	 = strtoupper(get_field('lieu'));

  $tags = array($Pnom, $Ppromotion, $Pdiplome, $Plieu);

  $filt = 0;
  $match = 0;

  for($i = 0; $i < 4; $i++){

    if($filter[$i] != NULL){

      $filt++;

      if($i != 2){
        $compare = strpos($tags[$i], $filter[$i]);
        if(is_int($compare))
          $match++;
      }
      else{
        if(!empty($tags[$i])){
          foreach($tags[$i] as $diplome) {        
            $string = strtoupper($diplome['diplome']);
            $compare = strpos($string, $filter[$i]);
            if(is_int($compare)){
              $match++;
            }
          }
        }
      }

    }

  }

  if($match == $filt){
    if(get_field('prenom') != NULL && get_field('nom') != NULL && get_field('promotion') != NULL){
      include(locate_template('etudiant.php'));
    }
  }

  endwhile;
    ?>

  </div>
</div>

<?php 
} else {
?>
<div class="container">
  <div class="error">
    Vous devez être connecté pour acceder à ce contenue
  </div>
</div>
<?php
}
?>

<?php get_footer(); ?>
