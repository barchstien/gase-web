<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_ficheDocument.css" /> 
		<title>ARCHIVES</title>
    </head>

	<?php
	require("inde_fonctionsDOCU.php");
	$idType = $_POST['idType'];
	$nomType = SelectionNomTypeDoc($idType);
	?>
    
	<body>
		<div class="menu">
			<?php include 'inde_menu.php'; ?>
		</div>
		<div style="text-align:center">
			<br />
			<br />
			<br />
			<br />
			<br />
			<br />
			<form id="formulaire" method="post" action="inde_enregistrerNouveauDocument.php" enctype="multipart/form-data">
				<div id= "table">
					<input type="hidden" name="idType" value="<?php echo $idType; ?>" />
					<p class = "ligne">
						<label class = "col1" for="nomType">Type : </label>
						<input type= "text" class= "col2" name="nomType" id="nomType" value="<?php echo $nomType; ?>" disabled="disabled" />
					</p>
					<?php
					if($idType == 1)
					{
					?>
						<p class = "ligne">
							<label class = "col1" for="fournisseur">Fournisseur :</label>
							<select class= "col2" name="fournisseur" id="fournisseur" >
								<option value="" selected="selected"></option>
								<?php	
								$listeFournisseurs = SelectionListeFournisseurs();
								foreach($listeFournisseurs as $cle => $element)
								{
									?>
									<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
									<?php
								}
								?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="date">Date :</label>
							<input type="text" class= "col2" name="date" id="date" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="net">Net a payer :</label>
							<input type="text" class= "col2" name="net" id="net" />
						</p>
					<?php
					}
					else if ($idType == 2)
					{
					?>
						<p class = "ligne">
							<label class = "col1" for="fournisseur">Fournisseur :</label>
							<select class= "col2" name="fournisseur" id="fournisseur" >
								<option value="" selected="selected"></option>
								<?php	
								$listeFournisseurs = SelectionListeFournisseurs();
								foreach($listeFournisseurs as $cle => $element)
								{
									?>
									<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
									<?php
								}
								?>
							</select>
						</p>
						<p class = "ligne">
							<label class = "col1" for="date">Date :</label>
							<input type="text" class= "col2" name="date" id="date" />
						</p>
						<p class = "ligne">
							<label class = "col1" for="net">Net a payer :</label>
							<input type="text" class= "col2" name="net" id="net" />
						</p>
					<?php
					}
					else if ($idType == 3)
					{
					?>
						<p class = "ligne">
							<label class = "col1" for="date">Date :</label>
							<input type="text" class= "col2" name="date" id="date" />
						</p>
					<?php
					}
					?>
					<label for="mon_fichier">Fichier (format .pdf ou .doc ou .xls | taille max. 1 Mo) :</label><br />
					<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
					<input type="file" name="le_fichier" id="mon_fichier" /><br />
				</div>
				<br />
				<div id="bouton">
					<p>
						<input type="submit" value="Enregistrer" name="enregistrer">
					</p>
				</div>
			</form>
		</div>
	</body>
</html>
