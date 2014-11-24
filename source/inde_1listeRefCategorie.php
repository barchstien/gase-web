<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_1AchatsAdherent.css" /> 
		<title>ACHATS</title>
    </head>

	<?php
//	require("inde_fonctionsCAT.php"); 
	if (isset($_GET['idCategorie']))
	{
		$idCategorie = $_GET['idCategorie'];
		$_SESSION['inde_idCategorie'] = $idCategorie;
	}
	?>

	<body>
		<div class="menu">
			<?php include 'inde_menuAchats.php'; ?>
		</div>
		
		<div class="references">
			<?php include 'inde_listeReferences.php'; ?>
		</div>

		<div class="panier">
			<?php include 'inde_panier.php';	?>
		</div>
	</body>
</html>
