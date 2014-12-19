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
		<?php
		    require("inde_fonctionsMC.php");
		    require("inde_fonctionsAD.php");
		    require("inde_fonctionsREF.php");
            $soldeAdherent = SelectionSoldeAdherentMC($_SESSION['inde_adherent']);
            $prenom_nom = SelectionPrenomNomAdherent($_SESSION['inde_adherent']);
		?>
		<div class="name_and_balance">
		    <?php echo $prenom_nom, " - <strong>Solde : ", round($soldeAdherent, 2), " euros</strong>" ?>
		</div>
		<div class="references">
			<?php include 'inde_listeReferences.php';?>
		</div>

		<div class="panier">
			<?php include 'inde_panier.php';?>
		</div>
	</body>
</html>
