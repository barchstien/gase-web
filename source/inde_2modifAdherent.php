<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
        <title>MODIF. ADHERENT</title>
    </head>

	<?php 
	require("inde_fonctionsAD.php"); 
	
	$idAdherent= $_GET["idAdherent"];
	$donnees = SelectionDonneesAdherent($idAdherent);
	?>
	
	<?php include 'inde_menu.php'; ?>
	
	<body>
		<div style="text-align:center">
			Les champs avec une etoile doivent etre obligatoirement renseignes.
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerModifAdherent.php">
					<input type="hidden" name="idAdherent" value="<?php echo $idAdherent; ?>" />
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="nom">Nom* : </label>
							<input type= "text" class= "col2" name="nom" id="nom" value="<?php echo $donnees['NOM']; ?>" autofocus required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="prenom">Prenom : </label>
							<input type= "text" class= "col2" name="prenom" id="prenom" value="<?php echo $donnees['PRENOM']; ?>" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="email">EMail* : </label>
							<input type= "text" class= "col2" name="email" id="email" value="<?php echo $donnees['MAIL']; ?>" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="telephoneFixe">Telephone fixe : </label>
							<input type= "text" class= "col2" name="telephoneFixe" id="telephoneFixe" value="<?php echo $donnees['TELEPHONE_FIXE']; ?>" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="telephonePortable">Telephone portable : </label>
							<input type= "text" class= "col2" name="telephonePortable" id="telephonePortable" value="<?php echo $donnees['TELEPHONE_PORTABLE']; ?>" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="adresse">Adresse : </label>
							<input type= "text" class= "col2" name="adresse" id="adresse" value="<?php echo $donnees['ADRESSE']; ?>" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="ticket">Envoi ticket de caisse : </label>
							<select class= "col2" name="ticket" id="ticket" >
								<?php								
								if($donnees['TICKET_CAISSE'] == '0')
								{
									?>
									<option value="1">OUI</option>
									<option value="0" selected="selected">NON</option>
									<?php
								}
								else
								{
									?>
									<option value="1" selected="selected">OUI</option>
									<option value="0">NON</option>
									<?php
								}
								?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="commentaire">Commentaire :</label>
							<textarea name="commentaire" id="commentaire" cols="35" rows = "2"><?php echo $donnees['COMMENTAIRE']; ?></textarea>
						</p>
						<p class = "ligne">
							<label class = "col1" for="visible">Visible : </label>
							<select class= "col2" name="visible" id="visible" >
								<?php								
								if($donnees['VISIBLE'] == '0')
								{
									?>
									<option value="1">OUI</option>
									<option value="0" selected="selected">NON</option>
									<?php
								}
								else
								{
									?>
									<option value="1" selected="selected">OUI</option>
									<option value="0">NON</option>
									<?php
								}
								?>
							</select>
						</p>
					</div>
					<br />
					<div id="bouton">
						<p>
							<input type="submit" value="Modifier" name="modifierAdherent">
						</p>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
