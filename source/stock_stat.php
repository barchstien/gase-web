<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" /> 
		<title>Statistiques</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<?php require("fonctions_bd_gase.php");
		require("inde_fonctionsSTK.php");
		require("inde_fonctionsREF.php");
		$ref = SelectionDonneesReference($_GET['id']);
		?>
		
		<div style="text-align:center;position:relative;top:-20px;">
		    <select>
		        <option value="2014">2014</option>
		        <option value="2013">2013</option>
		    </select>
		    <strong><?php echo $ref["DESIGNATION"]?></strong> (<?php echo $ref["NOM_FOURNISSEUR"]?>)
		</div>
		<img style="display: block;margin-left:auto; margin-right:auto;" src="stock_stat_generate.php?id='<?php echo $_GET['id']; ?>'">
		



	</body>
</html>
