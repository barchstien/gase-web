<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
        <title>INVENTAIRE</title>
    </head>
    <body>
        <?php include 'inde_menu.php'; ?>
        <?php
            require("inde_fonctionsSTK.php");
            $listeSTK = SelectionListeSTK();
        ?>

		<form id="formulaire" method="post" action="inde_enregistrerInventaireSTK.php">
			<div>
			<table style="margin-left:auto; margin-right:auto;">
				<tr>
					<td><label class="colonne1"><strong>EN STOCK</strong></label></td>
					<td><label class="colonne2"><strong>INVENTAIRE</strong></label></td>
					<td><label class="colonne4"><strong>CATEGORIE</strong></label></td>
					<td><label class="colonne3"><strong>DESIGNATION</strong></label></td>
					<td><label class="colonne3"><strong>FOURNISSEUR</strong></label></td>
				</tr>	
				<?php				
				foreach($listeSTK as $element)
				{
					?>
					<tr>
						<td><label class="colonne1"><?php echo '[' . $element['STOCK'] . ']'; ?></label></td>
						<td><input class="colonne2" type= "text" name="<?php echo $element['ID_REFERENCE'];?>" id="<?php echo $element['ID_REFERENCE'];?>" /></td>
						<td><label class="colonne4"><?php echo stripslashes($element['CATEGORIE']); ?></label></td>
						<td><label class="colonne3"><?php echo stripslashes($element['DESIGNATION']); ?></label></td>
						<td><label class="colonne3"><?php echo stripslashes($element['NOM']); ?></label></td>
					</tr>
					<?php
				}
				?>
			</table>
			</div>
			<br />
			<div>
				<p>
					<input type="submit" value="Enregistrer" name="enregistrerInventaire">
				</p>
			</div>
		</form>
	</body>
</html>
