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
		<table style="margin-left:auto; margin-right:auto; max-width:1000px;">
			<tr>
				<td width="5%" align="center"><strong>QUANTITE</strong></td>
				<td width="10%" align="center"><strong>CATEGORIE</strong></td>
				<td width="30%" align="center"><strong>DESIGNATION</strong></td>
				<td width="20%" align="center"><strong>FOURNISSEUR</strong></td>
				<td width="5%" align="center"><strong>STATS</strong></td>
			</tr>
			<?php
			foreach($listeSTK as $ref)
			{
				?>
				<tr>
					<td><?php echo $ref['STOCK'];?></td>
					<td><?php echo $ref['CATEGORIE'];?></td>
					<td><?php echo $ref['DESIGNATION'];?></td>
					<td align="center"><?php echo $ref['NOM'];?></td>
					<td align="center"><a href="stock_stat.php?id=<?php echo $ref['ID_REFERENCE'];?>">stats</a></td>
				</tr>
				<?php
			}
			?>			
		</table>
	</body>
</html>
