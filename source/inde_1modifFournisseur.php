<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
		<title>FOURNISSEURS</title>
    </head>
    <body>
        <?php include 'inde_menu.php'; ?>
	    <?php require("fonctions_bd_fournisseurs.php"); ?>
		<div style="text-align:center">
			Cliquez sur le nom du fournisseur a modifier.
		<div>
		<br />
		<?php
			/*
			 * AC 29-01-2016
			 * Ajout d'un bouton pour afficher/masquer les références visibles
			 */
			$all = isset($_GET['all']) ? true : false;
			$link = $_SERVER["SCRIPT_NAME"];
			if (!$all) $link .= '?all';
		?>
		<div class="center">
			<a href="<?= $link ?>"><?= $all ? 'Masquer les non visibles' : 'Montrer les non visibles' ?></a>
		</div>
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
				$listeFournisseurs = SelectionListeFournisseurs($all);
				foreach($listeFournisseurs as $cle => $element)
				{
					$donneesFournisseur = SelectionDonneesFournisseur($cle);
					?>
					<tr <?= $donneesFournisseur['VISIBLE'] == 0 ? 'class="inactive"' : '' ?>>
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
