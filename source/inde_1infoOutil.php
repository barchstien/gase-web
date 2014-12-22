<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_1infoOutil.css" />
		<link rel="stylesheet" href="style_default.css" />
		<title>INFO OUTIL</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>

		<div style="text-align:center">
			<div>
				<form id="formulaire" method="post" action="inde_enregistrerInfoOutil.php">
					<div id= "table">
					    <legend>Nouvelle information :</legend>
						<p class = "ligne">
							<textarea name="info" id="info" cols="120" rows = "10"></textarea>
						</p>
						<div id="bouton">
							<input type="submit" value="Enregistrer" name="enregistrerInfoOutil">
						</div>
					</div>
				
				</form>
			</div>
		</div>
		
		<?php
		    require("fonctions_bd_gase.php");
			if (isset($_GET['remove_date'])){
			    //delete an entry
			    RemoveMessage($_GET['remove_date']);
			}
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
						<td><label class="colonne3">
						    <a href="inde_1infoOutil.php?remove_date=<?php echo $message['DATE']; ?>"><img src="../static/img_trash.png" title="suprimer entrée" alt="X" /></a>
						</label></td>
					</tr>
					<?php
				}
				?>
			</table>
			<?php
			}
		?>	
	</body>
</html>
