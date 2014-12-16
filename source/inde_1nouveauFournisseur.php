<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_form.css" /> 
        <title>NOUVEAU FOURNISSEUR</title>
    </head>

	<?php include 'inde_menu.php'; ?>
	
    <body>
		<div style="text-align:center">
			Les champs avec une etoile doivent etre obligatoirement renseignes.
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerNouveauFournisseur.php">
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="nom">Nom* : </label>
							<input type= "text" class= "col2" name="nom" id="nom" autofocus required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="mail">Email : </label>
							<input type= "text" class= "col2" name="mail" id="mail" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="adresse">Adresse :</label>
							<input type="text" class= "col2" name="adresse" id="adresse" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="contact">Nom contact :</label>
							<input type="text" class= "col2" name="contact" id="contact" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="telephoneFixe">Telephone fixe :</label>
							<input type="text" class= "col2" name="telephoneFixe" id="telephoneFixe" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="telephonePortable">Telephone portable :</label>
							<input type="text" class= "col2" name="telephonePortable" id="telephonePortable" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="fax">Fax :</label>
							<input type="text" class= "col2" name="fax" id="fax" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="commentaire">Commentaire :</label>
							<textarea name="commentaire" id="commentaire" cols="35" rows = "2"></textarea>
						</p>
						<p class = "ligne">
							<label class = "col1" for="visible">Visible :</label>
							<select type="text" class= "col2" name="visible" id="visible">
								<option value="0">NON</option>
								<option value="1" selected="selected">OUI</option>
							</select>
						</p>
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





