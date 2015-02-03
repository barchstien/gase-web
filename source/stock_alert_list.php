<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
		<title>ALERTES STOCKS</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

        <h2 style="text-align:center;">Alertes Stock</h2>
		<?php	
		require("inde_fonctionsSTK.php");
		$list_alertes = getReferencesWithStockAlert();
		?>
		<table style="margin-left:auto; margin-right:auto; max-width:1000px;">
			<tr>
				<td width="10%" align="center"><strong>QUANTITE</strong></td>
				<td width="10%" align="center"><strong>ALERTE</strong></td>
				<td width="10%" align="center"><strong>CATEGORIE</strong></td>
				<td width="50%" align="center"><strong>DESIGNATION</strong></td>
				<td width="20%" align="center"><strong>FOURNISSEUR</strong></td>
			</tr>
			<?php
			if (count($list_alertes) != 0){
			    foreach($list_alertes as $ref)
			    {
				    ?>
				    <tr>
					    <td><?php echo $ref['STOCK'];?></td>
					    <td><?php echo $ref['ALERT_STOCK'];?></td>
					    <td><?php echo $ref['CATEGORIE'];?></td>
					    <td><?php echo $ref['DESIGNATION'];?></td>
					    <td align="center"><?php echo $ref['NOM'];?></td>
				    </tr>
				    <?php
			    }
			}
			?>			
		</table>
	</body>
</html>
