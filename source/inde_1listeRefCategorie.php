<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" />
		<link rel="stylesheet" href="style_form.css" />
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
		<?php include 'inde_menuAchats.php'; ?>
		
		<div class="references">
			<?php include 'inde_listeReferences.php'; ?>
		</div>

		<div class="panier">
			<?php include 'inde_panier.php';	?>
		</div>
	</body>
</html>
