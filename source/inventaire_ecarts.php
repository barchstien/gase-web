<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
		<title>Inventaire : Ecarts</title>
    </head>

    <body>
		<?php include 'inde_menu.php';
		require("inde_fonctionsSTK.php");
		$inventaire_date_list = get_inventaires_dates();
		//display last inventaire available by default
		$inventaire_date_selected = max($inventaire_date_list);
		if (isset($_GET['inventaire_date'])){
            $inventaire_date_selected = $_GET['inventaire_date'];
        }
        //error_log("$inventaire_selected");
        $list_ecarts = get_ecarts_list_for_date($inventaire_date_selected);
        //compute total here, to show it on top of page
        $total_ecart = 0;
		foreach($list_ecarts as $e){
			$total_ecart+=$e['ref_prix'] * $e['ecart'];
		}
		?>
		
        <div style="text-align:center;position:relative;top:-20px;z-index:0;">
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
             - <strong>Total Ecart : </strong><?php echo $total_ecart ?> euro
            </form>
        </div>
        
        <table style="margin-left:auto; margin-right:auto;">
			<tr>
				<td width="5%" align="center"><strong>ECART</strong></td>
				<td width="5%" align="center"><strong>ECART Euro</strong></td>
				<td width="10%" align="center"><strong>CATEGORIE</strong></td>
				<td width="50%" align="center"><strong>DESIGNATION</strong></td>
				<td width="20%" align="center"><strong>FOURNISSEUR</strong></td>
				<td width="5%" align="center"><strong>STATS</strong></td>
			</tr>
			<?php
			foreach($list_ecarts as $e)
			{
				?>
				<tr>
					<td width="5%"><?php echo $e['ecart'];?></td>
					<td width="5%"><?php echo round($e['ref_prix']*$e['ecart'], 2);?></td>
					<td width="10%"><?php echo $e['categorie_nom'];?></td>
					<td width="50%"><?php echo $e['ref_designation'];?></td>
					<td width="20%" align="center"><?php echo $e['fournisseur_nom'];?></td>
					<td width="5%" align="center"><!--<a href="stock_stat.php?id=<?php echo $ref['ID_REFERENCE'];?>">stats</a>--></td>
				</tr>
				<?php
			}
			?>			
		</table>
	</body>
</html>
