<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" /> 
        <title>NOUVELLE CATEGORIE</title>
    </head>

	<?php include 'inde_menu.php'; ?>
	
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





