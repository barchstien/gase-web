<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
		<title>STOCKS</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<?php
		require("inde_fonctionsSTK.php");
		$listeSTK = SelectionListeSTK();
		?>
		<table style="margin-left:auto; margin-right:auto;">
			<tr>
				<td width="5%" align="center"><strong>QUANTITE</strong></td>
				<td width="10%" align="center"><strong>CATEGORIE</strong></td>
				<td width="50%" align="center"><strong>DESIGNATION</strong></td>
				<td width="20%" align="center"><strong>FOURNISSEUR</strong></td>
				<td width="5%" align="center"><strong>STATS</strong></td>
			</tr>
			<?php
			foreach($listeSTK as $ref)
			{
				?>
				<tr>
					<td width="5%"><?php echo $ref['STOCK'];?></td>
					<td width="10%"><?php echo $ref['CATEGORIE'];?></td>
					<td width="50%"><?php echo $ref['DESIGNATION'];?></td>
					<td width="20%" align="center"><?php echo $ref['NOM'];?></td>
					<td width="5%" align="center"><a href="stock_stat.php?id=<?php echo $ref['ID_REFERENCE'];?>">stats</a></td>
				</tr>
				<?php
			}
			?>			
		</table>
	</body>
</html>
