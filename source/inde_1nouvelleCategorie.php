<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
        <link rel="stylesheet" href="inde_1nouvelleCategorie.css" /> 
        <title>NOUVELLE CATEGORIE</title>
    </head>

	<div class="menu">
		<?php include 'inde_menu.php'; ?>
	</div>
	
    <body>
		<div style="text-align:center">
			<form id="formulaire" method="post" action="inde_2nouvelleCategorie.php">
				<p class = "ligne">
					<label class = "col1" for="sousCategorie">Voulez-vous creer une nouvelle sous-categorie ? : </label>
					<select name="sousCategorie" id="sousCategorie" onchange="this.form.submit()">
						<option value="" selected="selected"></option>
						<option value="0">NON</option>
						<option value="1">OUI</option>
					</select>
				</p>
			</form>
		</div>
	</body>
</html>





