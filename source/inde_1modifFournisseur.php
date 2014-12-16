<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
		<title>FOURNISSEURS</title>
    </head>

	<?php require("fonctions_bd_fournisseurs.php"); ?>
	
	<?php include 'inde_menu.php'; ?>
	
    <body>
		<div style="text-align:center">
			Cliquez sur le nom du fournisseur a modifier.
		<div>
		<br />
		<div class="liste" style="text-align:left">
			<table>
				<tr>
					<td><label class="colonne1"><center><strong>NOM</strong></center></label></td>
					<td><label class="colonne2"><center><strong>MAIL</strong></center></label></td>
					<td><label class="colonne3"><center><strong>CONTACT</strong></center></label></td>
					<td><label class="colonne4"><center><strong>TELEPHONE FIXE</strong></center></label></td>
					<td><label class="colonne5"><center><strong>TELEPHONE PORTABLE</strong></center></label></td>
					<td><label class="colonne6"><center><strong>FAX</strong></center></label></td>
					<td><label class="colonne7"><center><strong>VISIBLE</strong></center></label></td>
					<td><label class="colonne8"><center><strong>DATE DE REFERENCEMENT</strong></center></label></td>
				</tr>
				<?php	
				$listeFournisseurs = SelectionListeFournisseurs();
				foreach($listeFournisseurs as $cle => $element)
				{
					$donneesFournisseur = SelectionDonneesFournisseur($cle);
					?>
					<tr>
					   <td><a href="inde_2modifFournisseur.php?idFournisseur=<?php echo  $cle; ?>" title="<?php echo $element; ?>" class="bouton"><?php echo  "&nbsp;".$element."&nbsp;"; ?></a></td>
					   <td><label class="colonne2"></label><?php echo  "&nbsp;".$donneesFournisseur['MAIL']."&nbsp;"; ?></td>
					   <td><label class="colonne3"></label><?php echo  "&nbsp;".$donneesFournisseur['CONTACT']."&nbsp;"; ?></td>
					   <td><label class="colonne4"></label><?php echo  "&nbsp;".$donneesFournisseur['TELEPHONE_FIXE']."&nbsp;"; ?></td>
					   <td><label class="colonne5"></label><?php echo  "&nbsp;".$donneesFournisseur['TELEPHONE_PORTABLE']."&nbsp;"; ?></td>
					   <td><label class="colonne6"></label><?php echo  "&nbsp;".$donneesFournisseur['FAX']."&nbsp;"; ?></td>
					   <?php
					   if($donneesFournisseur['VISIBLE'] == 0)
					   {
						   ?>
						   <td><label class="colonne10"></label>NON</td>
						   <?php
					   }
					   else
					   {
							?>
							<td><label class="colonne10"></label>OUI</td>
							<?php					   
					   }
					   ?>
					   <td><label class="colonne8"></label><?php echo  "&nbsp;".$donneesFournisseur['DATE_REFERENCEMENT']."&nbsp;"; ?></td>
					</tr>
					<?php
				}
				?>
			</table>					
		</div>
	</body>
</html>
