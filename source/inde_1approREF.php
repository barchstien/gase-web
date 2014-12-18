<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>STOCKS</title>
    </head>

    <body>
		<?php include 'inde_menu.php'; ?>
		
		<?php require("fonctions_bd_fournisseurs.php"); ?>
		<div style="text-align:center">
			Choisissez un fournisseur.
			<br>
			<br>
			<form id="formulaire" method="post" action="inde_approREF.php">
				<select name="fournisseur" id="fournisseur" onchange="this.form.submit()">
					<option value="" selected="selected"></option>
					<?php	
					$listeFR = SelectionListeFournisseurs();
					foreach($listeFR as $cle => $element)
					{
						?>
						<option value="<?php echo $cle; ?>"><?php echo $element; ?></option>
						<?php
					}
					?>
				</select>
			</form>
		</div>
	</body>
</html>
