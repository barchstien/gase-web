<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" /> 
		<title>Statistiques</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<?php require("fonctions_bd_gase.php"); ?>
		<?php require("inde_fonctionsSTK.php"); ?>
		
		<img style="display: block;margin-left:auto; margin-right:auto;" src="stock_stat_generate.php?id='<?php echo $_GET['id']; ?>'">
		



	</body>
</html>
