<?php acf_form_head(); ?>
<?php get_header(); ?>

<div class="state"></div>

<div class="container">
  <div class="depose">

    <h2>DÉPOSER UNE NOUVELLE OFFRE</h2>

    <form method="post">

      <div class="date">
        <label for="date">Date de début de l'offre (jj/mm/aaaa) :</label>
        <input type="text" name="date">
      </div>

      <div class="contrat">
        <?php 
        $termsContrat = get_terms( 'contrat', 'orderby=id&hide_empty=0' );
        ?>
        <label for="contrat">Contrat proposé :</label>
        <span>
          <?php	foreach($termsContrat as $term ) :	?>
          <input type="radio" name='contrat' value="<?php echo $term->name ?>"> <?php echo $term->name ?>
          <?php endforeach; ?>
        </span>
      </div>

      <div class="entreprise">
        <label for="entreprise">Entreprise proposant l'offre :</label>
        <select name="poste" id="">
          <option value=""></option>       
          <?php 
          $termsEntreprise = get_terms( 'entreprise', 'orderby=id&hide_empty=0' );
          ?>
          <?php	foreach($termsEntreprise as $term ) :	?>
          <option value="<?php echo $term->name ?>"><?php echo $term->name ?></option>
          <?php endforeach; ?>
        </select>

        <div class="add">
          Si celle-ci n'est pas disponible, ajoutez la :
          <input type="text">
          <button>Ajouter</button>
        </div>

      </div>

      <div class="poste">
        <label for="poste">Poste proposé :</label>
        <select name="poste" id="">
          <option value=""></option>       
          <?php 
          $termsPoste = get_terms( 'poste', 'orderby=id&hide_empty=0' );
          ?>
          <?php	foreach($termsPoste as $term ) :	?>
          <option value="<?php echo $term->name ?>"><?php echo $term->name ?></option>
          <?php endforeach; ?>
        </select>

        <div class="add">
          Si celui-ci n'est pas disponible, ajoutez le :
          <input type="text">
          <button>Ajouter</button>
        </div>

      </div>

      <div class="lieu">
        <label for="lieu">Ville du lieu travail :</label>
        <select name="lieu" id="">
          <option value=""></option>       
          <?php 
          $termsLieu = get_terms( 'lieu', 'orderby=id&hide_empty=0' );
          ?>
          <?php	foreach($termsLieu as $term ) :	?>
          <option value="<?php echo $term->name ?>"><?php echo $term->name ?></option>
          <?php endforeach; ?>
        </select>

        <div class="add">
          Si celui-ci n'est pas disponible, ajoutez le :
          <input type="text">
          <button>Ajouter</button>
        </div>

      </div>

      <div class="duree">
        <label for="duree">Durée de la mission (en mois) :</label>
        <input type="number" name="duree">
      </div>

      <div class="salaire">
        <label for="salaire">Salaire mensuel proposé (en €) :</label>
        <input type="number" name="salaire"> 
      </div>

      <div class="description">
        <label for="description">Description de la mission :</label>
        <br>
        <textarea name="description"></textarea>
      </div>

      <div class="mail">
        <label for="mail">Contact pour obtenir le poste :</label>
        <input type="email" name="mail">
      </div>

      <div class="submit">
        <input type="submit" value="POSTER OFFRE">
      </div>
      
    </form>
  </div>
</div>
<?php get_footer(); ?>