<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
       <link rel="stylesheet" href="inde_ficheReference.css" /> 
        <title>NOUVELLE REFERENCE</title>
    </head>

    <body>
		<div class="menu">
			<?php include 'inde_menu.php'; ?>
		</div>

		<?php 
		require("inde_fonctionsFR.php"); 
		require("inde_fonctionsCAT.php");
		?>
		<div style="text-align:center">
			Les champs avec une etoile doivent etre obligatoirement renseignes.<br />
			Le prix TTC doit etre indique a l unite ou au kilo.<br />
			Le nom du produit a ecrire en minuscule avec une majuscule au debut, en indiquant si possible le poids ou le volume.
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerNouvelleReference.php">
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="designation">Designation* :</label>
							<input type="text" class= "col2" name="designation" id="designation" autofocus required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="fournisseur">Fournisseur* :</label>
							<select class= "col2" name="fournisseur" id="fournisseur" required>
								<option value="" selected="selected"></option>
								<?php	
								$listeFR = SelectionListeVisiblesFR();
								foreach($listeFR as $cle => $element)
								{
									?>
									<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
									<?php
								}
								?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="categorie">Categorie* :</label>
							<select class= "col2" name="categorie" id="categorie" required >
								<option value="" selected="selected"></option>
								<?php	
								$listeCategories = SelectionListeCategoriesFilles();
								foreach($listeCategories as $cle => $element)
								{
									?>
									<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
									<?php
								}
								?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="prix">Prix TTC* :</label>
							<input type="text" class= "col2" name="prix" id="prix" required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="tva">T.V.A. :</label>
							<select class= "col2" name="tva" id="tva">
								<option value="0" selected="selected">0</option>
								<option value="5.5">5.5</option>
								<option value="19.6">19.6</option>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="vrac">Vrac :</label>
							<select type="text" class= "col2" name="vrac" id="vrac">
								<option value="0" selected="selected">NON</option>
								<option value="1">OUI</option>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="codeFournisseur">Code fournisseur :</label>
							<input type="text" class= "col2" name="codeFournisseur" id="codeFournisseur" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="commentaire">Commentaire :</label>
							<textarea name="commentaire" id="commentaire" cols="35" rows = "2"></textarea>
						</p>
						<p class = "ligne">
							<label class = "col1" for="visible">Visible :</label>
							<select type="text" class= "col2" name="visible" id="visible">
								<option value="1" selected="selected">OUI</option>
								<option value="0">NON</option>
							</select>
						</p>
					</div>
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





