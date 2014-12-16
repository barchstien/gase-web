<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" /> 
		<title>Statistiques</title>
    </head>

    <body>
		<?php include 'inde_menu.php';
		require("fonctions_bd_gase.php");
		require("inde_fonctionsSTK.php");
		require("inde_fonctionsREF.php");
		$ref_id = $_GET['id'];
		$ref_details = SelectionDonneesReference($ref_id);
		$year_list = getYearWithStats_forReferenceId($ref_id);
		?>
		
		<div style="text-align:center;position:relative;top:-20px;z-index:0;">
		    <select>
		        <?php foreach($year_list as $year){
		            echo "<option style='z-index:0;' value='$year'>$year</option>";
		        }?>
		    </select>
		    <strong><?php echo $ref_details["DESIGNATION"]?></strong> (<?php echo $ref_details["NOM_FOURNISSEUR"]?>)
		</div>
		<img style="display: block;margin-left:auto; margin-right:auto;" src="stock_stat_generate.php?id='<?php echo $_GET['id']; ?>'">
		



	</body>
</html>
