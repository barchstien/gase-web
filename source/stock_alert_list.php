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
		$liste_alertes = getReferencesWithStockAlertRaised();
		?>
		<table style="margin-left:auto; margin-right:auto;">
			<tr>
				<td width="10%" align="center"><strong>QUANTITE</strong></td>
				<td width="10%" align="center"><strong>ALERTE</strong></td>
				<td width="10%" align="center"><strong>CATEGORIE</strong></td>
				<td width="50%" align="center"><strong>DESIGNATION</strong></td>
				<td width="20%" align="center"><strong>FOURNISSEUR</strong></td>
			</tr>
			<?php
			foreach($liste_alertes as $ref)
			{
				?>
				<tr>
					<td width="10%"><?php echo $ref['STOCK'];?></td>
					<td width="10%"><?php echo $ref['ALERT_STOCK'];?></td>
					<td width="10%"><?php echo $ref['CATEGORIE'];?></td>
					<td width="50%"><?php echo $ref['DESIGNATION'];?></td>
					<td width="20%" align="center"><?php echo $ref['NOM'];?></td>
				</tr>
				<?php
			}
			?>			
		</table>
	</body>
</html>
