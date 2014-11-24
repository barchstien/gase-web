<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_1modifReference.css" /> 
		<title>REFERENCES</title>
    </head>

	<?php 
	require("inde_fonctionsREF.php"); 
	require("inde_fonctionsFR.php"); 
	require("inde_fonctionsCAT.php"); 
	?>
	
	<div class="menu">
		<?php include 'inde_menu.php'; ?>
	</div>
	
    <body>
		<div style="text-align:center">
			Cliquez sur le nom de la reference a modifier.
		<div>
		<br />
		<div class="liste" style="text-align:left">
			<table>
				<tr>
					<td><label class="colonne3"><center><strong>CATEGORIE</strong></center></label></td>
					<td><label class="colonne1"><center><strong>DESIGNATION</strong></center></label></td>
					<td><label class="colonne2"><center><strong>FOURNISSEUR</strong></center></label></td>
					<td><label class="colonne4"><center><strong>PRIX</strong></center></label></td>
					<td><label class="colonne5"><center><strong>VRAC</strong></center></label></td>
					<td><label class="colonne7"><center><strong>VISIBLE</strong></center></label></td>
					<td><label class="colonne8"><center><strong>DATE DE REFERENCEMENT</strong></center></label></td>
				</tr>
				<?php	
				$listeReferences = SelectionListeReferences();
				foreach($listeReferences as $cle => $element)
				{
					$donneesReference = SelectionDonneesReference($cle);
					$nomFournisseur = SelectionNomFournisseur($donneesReference['ID_FOURNISSEUR']);
					$nomCategorie = SelectionNomCategorie($donneesReference['ID_CATEGORIE']);
					?>
					<tr>
					   <td><label class="colonne3"></label><?php echo  "&nbsp;".$nomCategorie."&nbsp;"; ?></td>
					   <td><a href="inde_2modifReference.php?idReference=<?php echo  $cle; ?>" title="<?php echo $element; ?>" class="bouton"><?php echo  "&nbsp;".$element."&nbsp;"; ?></a></td>
					   <td><label class="colonne2"></label><?php echo  "&nbsp;".$nomFournisseur."&nbsp;"; ?></td>
					   <td><label class="colonne4"></label><?php echo  "&nbsp;".$donneesReference['PRIX_TTC']."&nbsp;"; ?></td>
					   
					   <?php
					   if($donneesReference['VRAC'] == 0)
					   {
							?>
							<td><label class="colonne5"></label>NON</td>
							<?php
					   }
					   else
					   {
							?>
							<td><label class="colonne5"></label>OUI</td>
							<?php					   
					   }
					   if($donneesReference['VISIBLE'] == 0)
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
					   <td><label class="colonne8"></label><?php echo  "&nbsp;".$donneesReference['DATE_REFERENCEMENT']."&nbsp;"; ?></td>
					</tr>
					<?php
				}
				?>
			</table>					
		</div>
	</body>
</html>
