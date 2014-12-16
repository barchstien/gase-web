<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
		<title>COMPTE</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<div style="text-align:center">
			Versement effectue.
			</br>
			</br>
			<?php
			$solde = SelectionSoldeAdherentMC($idAdherent);
			echo 'N oubliez pas de deposer l argent en caisse.<br />'; 
			echo 'Le solde est maintenant de ' .$solde. ' euros.';
			?>
		</div>
	</body>
</html>





