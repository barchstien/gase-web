<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style_default.css" /> 
		<title>Bienvenue au Gase</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<?php require("fonctions_bd_gase.php"); ?>
		<?php require("inde_fonctionsSTK.php"); ?>
		<div class="notification_alert_stock">
		    <?php $alert_list = getReferencesWithStockAlert();
		        if (count($alert_list) > 0){
		            echo "<strong>Alerte Stock ! </strong><a href=\"stock_alert_list.php\">détail</a>";
		        }
		    ?>
		</div>
		<div style="text-align:center">
			<div>
				JOURNAL DE BORD DE NOTRE OUTIL
				<br />
				<br />
				<?php
				$listeMessages = SelectionListeMessages();
				if(count($listeMessages) > 0)
				{
				?>
				<table>
					<tr>
						<td><label class="colonne1"><center><strong>DATE</strong></center></label></td>
						<td><label class="colonne2"><center><strong>MESSAGE</strong></center></label></td>
					</tr>
					<?php	
					foreach($listeMessages as $message)
					{
						?>
						<tr>
							<td><label class="colonne1"><center><strong><?php echo $message['DATE']; ?></strong></center></label></td>
							<td><label class="colonne2"><?php echo stripslashes($message['MESSAGE']); ?></label></td>
						</tr>
						<?php
					}
					?>
				</table>
				<?php
				}
				?>
			</div>
		</div>		
	</body>
</html>
