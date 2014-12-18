<?php
require("inde_fonctionsSTK.php");
$inventaire_date_list = get_inventaires_dates();
//display last inventaire available by default
$inventaire_date_selected = max($inventaire_date_list);
if (isset($_GET['inventaire_date'])){
    $inventaire_date_selected = $_GET['inventaire_date'];
}
$list_ecarts = get_ecarts_list_for_date($inventaire_date_selected);
//compute total here, to show it on top of page
$total_ecart = 0;
foreach($list_ecarts as $e){
	$total_ecart+=$e['ref_prix'] * $e['ecart'];
}

//// CSV file download
if (isset($_GET['type'])){
    if ("csv" == $_GET['type']){
        //error_log("  CSV  ");
        header('Content-type: application/csv');
        header('Content-Transfer-Encoding: binary');
        //total
        echo "Ecart Total (euro), ", round($total_ecart, 2), "\n";
        //column titles
        echo "ECART (unité/kg/l), ECART (euro), CATEGORIE, DESIGNATION, FOURNISSEUR\n";
        //data
        foreach($list_ecarts as $e){
		    echo $e['ecart'], ", ";
		    echo round($e['ref_prix']*$e['ecart'], 2), ", ";
		    echo $e['categorie_nom'], ", ";
		    echo $e['ref_designation'], ", ";
		    echo $e['fournisseur_nom'], "\n";
	    }
        exit();
    }
}
//// CSV end
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
		<title>Inventaire : Ecarts</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>
		
        <div style="text-align:center;position:relative;z-index:0;">
            <form action="inventaire_ecarts.php" method="GET">
            <strong>Inventaire du : </strong>
            <select name="inventaire_date" onchange="this.form.submit()">
                <?php foreach($inventaire_date_list as $i){
                    if ($i == $inventaire_date_selected){
                        echo "<option value='$i' selected>$i</option>";
                    }else{
                        echo "<option value='$i'>$i</option>";
                    }
                }?>
            </select>
             - <strong>Total Ecart* : </strong><?php echo round($total_ecart, 2) ?> euro
            </form>
        </div>
        
        <table style="margin-left:auto; margin-right:auto;max-width:1000px;">
			<tr>
				<td width="5%" align="center"><strong>ECART** (unité/kg/l)</strong></td>
				<td width="5%" align="center"><strong>ECART** (euro)</strong></td>
				<td width="10%" align="center"><strong>CATEGORIE</strong></td>
				<td width="20%" align="center"><strong>DESIGNATION</strong></td>
				<td width="10%" align="center"><strong>FOURNISSEUR</strong></td>
				<td width="5%" align="center"><strong>STATS</strong></td>
			</tr>
			<?php
			foreach($list_ecarts as $e)
			{
				?>
				<tr>
					<td><?php echo $e['ecart'];?></td>
					<td><?php echo round($e['ref_prix']*$e['ecart'], 2);?></td>
					<td><?php echo $e['categorie_nom'];?></td>
					<td><?php echo $e['ref_designation'];?></td>
					<td align="center"><?php echo $e['fournisseur_nom'];?></td>
					<td align="center"><!--<a href="stock_stat.php?id=<?php /*echo $ref['ID_REFERENCE'];*/?>">stats</a>--></td>
				</tr>
				<?php
			}
			?>
		</table>
		<br>
		<div style="text-align:center;">
		    <a href="inventaire_ecarts.php?inventaire_date=<?php echo $inventaire_date_selected ?>&type=csv" 
		        download="ecarts_<?php echo $inventaire_date_selected ?>.csv">
		        <button type="button">export CSV</button>
		    </a>
		    <!-- <form method="get" action="/"><button type="submit">export CSV</button></form> -->
		</div>
		<div style="text-align:center;">
		    <strong>*</strong>Les prix utilisés sont les prix actuellement enregistrés. Il est possible qu'il soient différents de ceux utilisé lors de l'inventaire
		</div>
		<div style="text-align:center;">
		    <strong>**</strong>Une valeur négative signifie une perte (un produit disparu)
		</div>
		<br>
	</body>
</html>
