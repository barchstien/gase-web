<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
		<title>COMPTE</title>
    </head>

    <body>
		<div class="menu">
			<p>
				<?php include 'inde_menu.php'; ?>
			</p>
		</div>

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





