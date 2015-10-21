<?php 

get_header();
echo '<pre>';
print_r($_POST);
echo '</pre>';
?>
<div id="content">
	<form action="#" method="POST">

		<label for="title">Poste</label>
		<br>
		<input type="text" name="title" id="title">
		<br><br>
		
		<label for="content">Description du poste</label>
		<br>
		<input type="text" name="content" id="content">
		<br><br>

		<label for="entreprise">Entreprise</label>
		<br>
		<input type="text" name="entreprise" id="entreprise">
		<br><br>
		
		<p>Contrat</p>
		<label>
			CDD
			<input name="type_de_contrat" type="radio" value="CDD">
		</label>
		<br>
		<label>
			CDI
			<input name="type_de_contrat"  type="radio" value="CDI">
		</label>
		<br>
		<label>
			Stage
			<input name="type_de_contrat" type="radio" value="stage">
		</label>
		<br>
		<br>
		
		<label for="email">mail</label>
		<br>
		<input type="email" name="email" id="email">
		<br><br>
		
		<label for="telephone">Téléphone</label>
		<br>
		<input type="tel" name="telephone" id="telephone">
		<br><br>
		
		<label for="adresse">Adresse</label>
		<br>
		<input type="text" name="adresse" id="adresse">
		<br><br>
		
		<label for="date_de_debut">Date de début</label>
		<br>
		<input type="date" name="date_de_debut" id="date_de_debut">
		<br><br>

		<label for="remuneration">Rémunération</label>
		<br>
		<input type="text" name="remuneration" id="remuneration">
		<br><br>
		
		<input type="submit" value="Poster une offre">
	</form>
	<?php
		if (!empty($_POST)){

			$post = array(
				'post_title'     => $_POST['title'],
				'post_content'   => $_POST['content'],
				'post_status'    => 'publish',
				'post_type'      => 'offre'
			);
			$post_id = wp_insert_post($post);
			update_field('field_5616b99ae6ece', $_POST['entreprise'], $post_id);
			update_field('field_5616b9aae6ecf', $_POST['type_de_contrat'], $post_id);
			update_field('field_5616b9ece6ed0', $_POST['email'], $post_id);
			update_field('field_5616b9fde6ed1', $_POST['telephone'], $post_id);
			update_field('field_5616ba0ee6ed2', $_POST['adresse'], $post_id);
			update_field('field_5616ba20e6ed3', $_POST['date_de_debut'], $post_id);
			update_field('field_5616ba7ee6ed4', $_POST['remuneration'], $post_id);

			
	
		}
	?>
	
</div>

<?php get_footer(); ?>