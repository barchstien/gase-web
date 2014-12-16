<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_1infoOutil.css" /> 
		<title>INFO OUTIL</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<div style="text-align:center">
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerInfoOutil.php">
					<div id= "table">
						<p class = "ligne">
							<label class = "col1" for="info">Nouvelle information :</label>
							<textarea name="info" id="info" cols="50" rows = "10"></textarea>
						</p>
						<br />
						<div id="bouton">
							<p>
								<input type="submit" value="Enregistrer" name="enregistrerInfoOutil">
							</p>
						</div>
					</div>
				</form>
			</div>
		</div>		
	</body>
</html>
