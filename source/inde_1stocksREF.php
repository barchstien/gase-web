<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_stocksREF.css" />
		<title>STOCKS</title>
    </head>

    <body>
		<div class="menu">
			<?php include 'inde_menu.php'; ?>
		</div>

		<?php	
		require("inde_fonctionsSTK.php");
		$listeSTK = SelectionListeSTK();
		?>
		<table>
			<tr>
				<td width="10%" align="center"><strong>QUANTITE</strong></td>
				<td width="10%" align="center"><strong>CATEGORIE</strong></td>
				<td width="60%" align="center"><strong>DESIGNATION</strong></td>
				<td width="20%" align="center"><strong>FOURNISSEUR</strong></td>
			</tr>
			<?php
			foreach($listeSTK as $tableau)
			{
				?>
				<tr>
					<td width="10%"><?php echo $tableau['STOCK'];?></td>
					<td width="10%"><?php echo $tableau['CATEGORIE'];?></td>
					<td width="60%"><?php echo $tableau['DESIGNATION'];?></td>
					<td width="20%" align="center"><?php echo $tableau['NOM'];?></td>
				</tr>
				<?php
			}
			?>			
		</table>
	</body>
</html>