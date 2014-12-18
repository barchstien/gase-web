<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>ACHATS</title>
    </head>
    <body>
		<?php include 'inde_menu.php'; ?>
		
		<?php require("inde_fonctionsAD.php"); ?>
		<div style="text-align:center">
			Choisissez le nom d un adherent.
			</br>
			</br>
			<form id="formulaire" method="post" action="inde_1achatsAdherent.php">
				<select name="adherent" id="adherent" onchange="this.form.submit()">
					<option value="" selected="selected"></option>
					<?php	
					$listeAD = SelectionListeActifsAD();
					foreach($listeAD as $adherent)
					{
						?>
						<option value="<?php echo $adherent['ID_ADHERENT']; ?>"><?php echo $adherent['PRENOM'] . ' ' . $adherent['NOM']; ?></option>
						<?php
					}
				?>
				</select>
			</form>
		</div>
	</body>
</html>
