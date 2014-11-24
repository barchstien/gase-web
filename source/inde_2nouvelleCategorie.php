<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
        <link rel="stylesheet" href="inde_ficheCategorie.css" /> 
        <title>NOUVELLE CATEGORIE</title>
    </head>

	<?php 
	require("inde_fonctionsCAT.php"); 
	?>
	
	<div class="menu">
		<?php include 'inde_menu.php'; ?>
	</div>
	
	<?php 
	$sousCat = $_POST['sousCategorie'];
	?>
	
    <body>
		<div style="text-align:center">
			Les champs avec une etoile doivent etre obligatoirement renseignes.
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerNouvelleCategorie.php">
					<div id= "table">
						<?php
						if($sousCat == 0)
						{
							?>
							<p class = "ligne">
								<label class = "col1" for="sousCategorie">C est une sous-categorie : </label>
								<input type="text" value="NON" disabled="disabled" />
								<input type="hidden" name="sousCategorie" value="<?php echo $sousCat; ?>" />
							</p>
							<p class = "ligne">
								<label class = "col1" for="nom">Nom* : </label>
								<input type= "text" class= "col2" name="nom" id="nom" autofocus required />
							</p>
							<?php
						}
						else
						{
							?>
							<p class = "ligne">
								<label class = "col1" for="sousCategorie">C est une sous-categorie : </label>
								<input type="text" value="OUI" disabled="disabled" />
								<input type="hidden" name="sousCategorie" value="<?php echo $sousCat; ?>" />
							</p>
							<p class = "ligne">
								<label class = "col1" for="nom">Nom* : </label>
								<input type= "text" class= "col2" name="nom" id="nom" autofocus required />
							</p>
							<p class = "ligne">
								<label class = "col1" for="catMere">Categorie mere* : </label>
								<select name="idCatSup" id="idCatSup" >
									<option value="" selected="selected"></option>
									<?php
									$listeCategoriesMeres = SelectionListeCategoriesMeres();

									foreach($listeCategoriesMeres as $cle => $element)
									{
										?>
										<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
										<?php
									}
									?>
								</select>
							</p>
							<?php
						}
						?>
					</div>
					<br />
					<div id="bouton">
						<p>
							<input type="submit" value="Enregistrer" name="enregistrer">
						</p>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>





