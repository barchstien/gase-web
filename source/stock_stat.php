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
		//display last year available by default
		$year_selected = max($year_list);
		if (isset($_GET['year'])){
            $year_selected = $_GET['year'];
        }
		?>
		
		<div style="text-align:center;position:relative;top:-20px;z-index:0;">
		    <form action="stock_stat.php" method="GET">
		    <input type="hidden" name="id" value="<?php echo $ref_id; ?>">
		    <select name="year" onchange="this.form.submit()">
		        <?php 
		        $cnt = 0;
		        foreach($year_list as $year){
		            if ($year_selected == $year){
		                echo "<option style='z-index:0;' value='$year' selected>$year</option>";
		            }else{
		                echo "<option style='z-index:0;' value='$year'>$year</option>";
		            }
		            $cnt ++;
		        }?>
		    </select>
		    <strong><?php echo $ref_details["DESIGNATION"]?></strong> (<?php echo $ref_details["NOM_FOURNISSEUR"]?>)
		    </form>
		</div>
		<?php $GET_param = "?id=$ref_id&year=$year_selected";?>
		<img style="display: block;margin-left:auto; margin-right:auto;" src="stock_stat_generate.php<?php echo $GET_param; ?>">
	</body>
</html>
