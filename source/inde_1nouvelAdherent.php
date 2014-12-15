<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" /> 
        <title>NOUVEL ADHERENT</title>
    </head>

	<div class="menu">
		<?php include 'inde_menu.php'; ?>
	</div>
	
    <body>
		<div style="text-align:center">
			Les champs avec une etoile doivent obligatoirement etre renseignes.
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerNouvelAdherent.php">
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="nom">Nom* : </label>
							<input type= "text" class= "col2" name="nom" id="nom" autofocus required/>
						</p>
						<p class = "ligne">
							<label class = "col1" for="prenom">Prenom : </label>
							<input type= "text" class= "col2" name="prenom" id="prenom" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="email">Email*<i>si ticket de caisse :</i> </label>
							<input type="email" class= "col2" name="email" id="email" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="telephone_fixe">Telephone fixe :</label>
							<input type="tel" class= "col2" name="telephone_fixe" id="telephone_fixe" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="telephone_portable">Telephone portable :</label>
							<input type="tel" class= "col2" name="telephone_portable" id="telephone_portable"/>
						</p>
						<p class = "ligne">
							<label class = "col1" for="adresse">Adresse :</label>
							<input type="text" class= "col2" name="adresse" id="adresse" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="ticket">Envoi ticket de caisse : </label>
							<select class= "col2" name="ticket" id="ticket" >
								<option value="1" selected="selected">OUI</option>
								<option value="0">NON</option>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="commentaire">Commentaire :</label>
							<textarea name="commentaire" id="commentaire" cols="35" rows = "2"></textarea>
						</p>
						<p class = "ligne">
							<label class = "col1" for="visible">Visible : </label>
							<select class= "col2" name="visible" id="visible" >
								<option value="1" selected="selected">OUI</option>
								<option value="0">NON</option>
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





