<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_1modifAdherent.css" /> 
		<title>ADHERENTS</title>
    </head>

	<?php 
	require("inde_fonctionsAD.php"); 
	?>
	
	<div class="menu">
		<?php include 'inde_menu.php'; ?>
	</div>
	
    <body>
		<div style="text-align:center">
			Cliquez sur le nom d un adherent pour modifier ses donnees.
		<div>
		<br />
		<div class="liste" style="text-align:left">
			<table>
				<tr>
					<td><label class="colonne1"><center><strong>NOM</strong></center></label></td>
					<td><label class="colonne2"><center><strong>PRENOM</strong></center></label></td>
					<td><label class="colonne3"><center><strong>EMAIL</strong></center></label></td>
					<td><label class="colonne4"><center><strong>TELEPHONE PORTABLE</strong></center></label></td>
					<td><label class="colonne5"><center><strong>TELEPHONE FIXE</strong></center></label></td>
					<td><label class="colonne6"><center><strong>DATE INSCRIPTION</strong></center></label></td>
				</tr>
				<?php	
				$listeADherents = SelectionListeAdherents();
				foreach($listeADherents as $cle => $element)
				{
					$donneesAd = SelectionDonneesAdherent($cle);
					?>
					<tr>
					   <td><a href="inde_2modifAdherent.php?idAdherent=<?php echo  $cle; ?>" title="<?php echo $element; ?>" class="bouton"><?php echo  "&nbsp;".$element."&nbsp;"; ?></a></td>
					   <td><label class="colonne2"></label><?php echo  "&nbsp;".$donneesAd['PRENOM']."&nbsp;"; ?></td>
					   <td><label class="colonne3"></label><?php echo  "&nbsp;".$donneesAd['MAIL']."&nbsp;"; ?></td>
					   <td><label class="colonne4"></label><?php echo  "&nbsp;".$donneesAd['TELEPHONE_PORTABLE']."&nbsp;"; ?></td>
					   <td><label class="colonne5"></label><?php echo  "&nbsp;".$donneesAd['TELEPHONE_FIXE']."&nbsp;"; ?></td>
					   <td><label class="colonne5"></label><?php echo  "&nbsp;".$donneesAd['DATE_INSCRIPTION']."&nbsp;"; ?></td>
					</tr>
					<?php
				}
				?>
			</table>					
		</div>
	</body>
</html>
