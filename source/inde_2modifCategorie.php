<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
        <title>MODIF. CATEGORIE</title>
    </head>

	<?php 
	require("inde_fonctionsCAT.php"); 
	
	$idCategorie= $_GET[idCategorie];
	$donneesCategorie = SelectionDonneesCategorie($idCategorie);

	?>
	
	<div class="menu">
		<?php include 'inde_menu.php'; ?>
	</div>
	
	<body>
		<div style="text-align:center">
			Les champs avec une etoile doivent etre obligatoirement renseignes.
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerModifCategorie.php">
					<input type="hidden" name="idCategorie" value="<?php echo $idCategorie; ?>" />
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="nom">Nom* : </label>
							<input type= "text" class= "col2" name="nom" id="nom" value="<?php echo $donneesCategorie['NOM']; ?>" autofocus required />
						</p>
						<p class = "ligne">
							<label class = "col1" for="visible">Visible :</label>
							<select class= "col2" name="visible" id="visible" >
								<?php
								if($donneesCategorie['VISIBLE'] == '0')
								{
									?>
									<option value="0" selected="selected">NON</option>
									<option value="1">OUI</option>
									<?php
								}
								else
								{
									?>
									<option value="0">NON</option>
									<option value="1" selected="selected">OUI</option>
									<?php
								}
								?>
							</select>
						</p>
						<?php
						if($donneesCategorie['ID_CAT_SUP'] != NULL)
						{
							?>
							<p class = "ligne">
								<label class = "col1" for="catMere">Categorie mere :</label>
								<select class= "col2" name="catMere" id="catMere" >
									<?php
									$listeCatMeres = SelectionListeCategoriesMeres();
									foreach($listeCatMeres as $cle => $element)
									{
										if($cle == $donneesCategorie['ID_CAT_SUP'])
										{
											?>
											<option value="<?php echo $cle; ?>" selected="selected"><?php echo $element; ?></option>
											<?php
										}
										else
										{
											?>
											<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
											<?php
										}
									}
									?>
								</select>
							</p>
							<?php
						}
						else
						{
						?>
							<input type="hidden" name="catMere" value="0" />
						<?php
						}
						?>
					</div>
					<br />
					<div id="bouton">
						<p>
							<input type="submit" value="Modifier" name="modifierCategorie">
						</p>
					</div>
				</form>
			</div>
		</div>
	</body>
</html>
