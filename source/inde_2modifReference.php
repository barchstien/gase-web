<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_form.css" />
        <title>MODIF. REFERENCE</title>
    </head>

	<?php 
	require("inde_fonctionsREF.php"); 
	require("fonctions_bd_fournisseurs.php"); 
	require("inde_fonctionsCAT.php"); 
	
	$idReference= $_GET["idReference"];
	$donnees = SelectionDonneesReference($idReference);
	$nomFournisseur = SelectionNomFournisseur($donnees['ID_FOURNISSEUR']);
	$nomCategorie = SelectionNomCategorie($donnees['ID_CATEGORIE']);
	?>
	
	<body>
	    <?php include 'inde_menu.php'; ?>

		<div style="text-align:center">
			Les champs avec une etoile doivent etre obligatoirement renseignes.
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerModifReference.php">
					<input type="hidden" name="idReference" value="<?php echo $idReference; ?>" />
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="designation">Designation* :</label>
							<input type="text" class= "col2" name="designation" id="designation" value="<?php echo $donnees['DESIGNATION']; ?>" autofocus required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="fournisseur">Fournisseur* :</label>
							<select class= "col2" name="fournisseur" id="fournisseur" required>
								<?php	
								$listeFR = SelectionListeVisiblesFR();
								foreach($listeFR as $cle => $element){
									if($element == $nomFournisseur){
										?>
										<option value="<?php echo $donnees['ID_FOURNISSEUR'] ?>" selected="selected"><?php echo $nomFournisseur; ?></option>
										<?php
									}else{
										?>
										<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
										<?php
									}
								}?>
							</select>
						</p>
                        <p class = "ligne">
							<label class = "col1" for="categorie">Categorie* :</label>
							<select class= "col2" name="categorie" id="categorie" required >
								<?php	
								$listeCategories = SelectionListeCategoriesFilles();
								foreach($listeCategories as $cle => $element){
									if($element == $nomCategorie){
										?>
										<option value="<?php echo $donnees['ID_CATEGORIE'] ?>" selected="selected"><?php echo $nomCategorie; ?></option>
										<?php
									}else{
										?>
										<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
										<?php
									}
								}?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="prix">Prix TTC* :</label>
							<input type="text" class= "col2" name="prix" id="prix" value="<?php echo $donnees['PRIX_TTC']; ?>" required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="tva">T.V.A. :</label>
							<select class= "col2" name="tva" id="tva">
								<?php								
								if($donnees['TVA'] == '0'){
									?>
									<option value="0" selected="selected">0</option>
									<option value="5.5">5.5</option>
									<option value="19.6">19.6</option>
									<?php
								}else if($donnees['TVA'] == '5.5'){
									?>
									<option value="0" >0</option>
									<option value="5.5" selected="selected">5.5</option>
									<option value="19.6">19.6</option>
									<?php
								}else if($donnees['TVA'] == '19.6'){
									?>
									<option value="0" >0</option>
									<option value="5.5" >5.5</option>
									<option value="19.6" selected="selected">19.6</option>
									<?php
								}?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="vrac">Vrac :</label>
							<select type="text" class= "col2" name="vrac" id="vrac">
								<?php								
								if($donnees['VRAC'] == '0'){
									?>
									<option value="1">OUI</option>
									<option value="0" selected="selected">NON</option>
									<?php
								}else{
									?>
									<option value="1" selected="selected">OUI</option>
									<option value="0">NON</option>
									<?php
								}?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="codeFournisseur">Code fournisseur :</label>
							<input type="text" class= "col2" name="codeFournisseur" id="codeFournisseur" value="<?php echo $donnees['CODE_FOURNISSEUR']; ?>"/>
						</p>
						<p class = "ligne">
							<label class = "col1" for="commentaire">Commentaire :</label>
							<textarea name="commentaire" id="commentaire" cols="35" rows = "2"><?php echo $donnees['COMMENTAIRE']; ?></textarea>
						</p>
						<p class = "ligne">
							<label class = "col1" for="visible">Visible : </label>
							<select class= "col2" name="visible" id="visible" >
								<?php								
								if($donnees['VISIBLE'] == '0'){
									?>
									<option value="1">OUI</option>
									<option value="0" selected="selected">NON</option>
									<?php
								}else{
									?>
									<option value="1" selected="selected">OUI</option>
									<option value="0">NON</option>
									<?php
								}?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="alert_stock">Alerte stock (quantité, kg, litre) : </label>
							<input type="text" class= "col2" name="alert_stock" id="alert_stock" value="<?php echo $donnees['ALERT_STOCK']; ?>" />
							<label class = "col1" for="alert_stock"><small>laisser vide si pas d'alerte</small></label>
						</p>
					</div>
					<div class="modifierReference"><p>
						<input type="submit" value="Modifier" name="modifierReference">
					</p></div>
				</form>
			</div>
		</div>
	</body>
</html>
