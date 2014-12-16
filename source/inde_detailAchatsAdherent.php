<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" /> 
        <title>DETAIL ACHATS</title>
    </head>

	<?php 
	//require("inde_fonctionsACH.php"); 
	require("fonctions_bd_gase.php"); 
	?>
	
	<?php include 'inde_menu.php'; ?>
	
    <body>
		<div style="text-align:center">
			<?php
			$idAchats = $_GET[idAch];
			$infosAchats = SelectionInfosAchats($idAchats);
			//this wasn't workin before nayway, should fix it
			echo "infosAchats " . $infosAchats;
			?>
			<br />
			<br />
			<div>
				<table>
					<tr>
					   <td><label class="colonne1"><strong>DESIGNATION</strong></label></td>
					   <td><label class="colonne2"><strong>P.U.</strong></label></td>
					   <td><label class="colonne3"><strong>QTE</strong></label></td>
					   <td><label class="colonne4"><strong>TOTAL</strong></label></td>
					</tr>
				
					<?php
					$detailsAchats = SelectionDetailsAchats($idAchats);
					foreach( $detailsAchats as $tableau ) 
					{
						?>
						<tr>
							<td><?php echo $tableau['DESIGNATION']; ?></td>
							<td><?php echo $tableau['PRIX_TTC']; ?></td>
							<td><?php echo $tableau['QUANTITE']; ?></td>
							<td><?php echo $tableau['TOTAL']; ?></td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
		</div>
		<br />
		<center>
		<li>Pour retourner a la liste des achats : <a href="inde_1achatsAdherent.php">cliquez ici</a></li>
		</center>
	</body>
</html>





