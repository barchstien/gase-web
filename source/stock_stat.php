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
		//get details of a reference, to display name and fournisseur name
		$ref_details = SelectionDonneesReference($ref_id);
		//get years during which this reference has been purchased
		$year_list = getYearWithPurchase_forReferenceId($ref_id);
		?>
		
		<div style="text-align:center;position:relative;top:-20px;z-index:0;">
		    <select>
		        <?php foreach($year_list as $year){
		            echo "<option style='z-index:0;' value='$year'>$year</option>";
		        }?>
		    </select>
		    <strong><?php echo $ref_details["DESIGNATION"]?></strong> (<?php echo $ref_details["NOM_FOURNISSEUR"]?>)
		</div>
		<?php
		    $GET_param = "?id='$ref_id'";
		    if(isset($_GET['year'])){
		        $GET_param .= "&year=".$_GET['year'];
		    }
		?>
		<img style="display: block;margin-left:auto; margin-right:auto;" src="stock_stat_generate.php<?php echo $GET_param; ?>">
	</body>
</html>
