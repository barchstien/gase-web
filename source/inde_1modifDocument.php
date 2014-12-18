<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style_default.css" />
		<title>ARCHIVES</title>
    </head>
    <body>
        <?php include 'inde_menu.php'; ?>
	    <?php 
	    require("inde_fonctionsDOCU.php");
	    require("fonctions_bd_fournisseurs.php");
	    ?>
		<div style="text-align:center">
			Ensemble des documents archives.
		<div>
		<br />
		<div class="liste" style="text-align:left">
		
			<?php
			$idType = 1;
			$listeDocuments = SelectionListeDocuments($idType);
			if(count($listeDocuments) > 0)
			{
			?>
			FACTURES
			<table>
				<tr>
					<td><label class="colonne1"><center><strong>NOM</strong></center></label></td>
					<td><label class="colonne2"><center><strong>DATE</strong></center></label></td>
					<td><label class="colonne3"><center><strong>FOURNISSEUR</strong></center></label></td>
					<td><label class="colonne4"><center><strong>NET A PAYER</strong></center></label></td>
				</tr>
				<?php	
				foreach($listeDocuments as $document)
				{
					$donneesFournisseur = SelectionDonneesFournisseur($document['ID_FOURNISSEUR']);
					$nomFournisseur = $donneesFournisseur['NOM'];
					?>
					<tr>
						<td><label class="colonne1"><center><strong><?php echo $document['NOM']; ?></strong></center></label></td>
						<td><label class="colonne2"><center><strong><?php echo $document['DATE']; ?></strong></center></label></td>
						<td><label class="colonne3"><center><strong><?php echo $nomFournisseur; ?></strong></center></label></td>
						<td><label class="colonne4"><center><strong><?php echo $document['NET_A_PAYER']; ?></strong></center></label></td>
						
						<td>
						<form method="post" action="inde_telechargerDocument.php" enctype="multipart/form-data">
							<input type="hidden" name="nomDocument" value="<?php echo './archives/-'.$document['ID_DOCUMENT'].'-'.$document['NOM']; ?>" />
							<input type="submit" name="submit" value="Telecharger" />
						</form>
						</td>	
					</tr>
					<?php
				}
				?>
			</table>	

			<?php
			}
			$idType = 2;
			$listeDocuments = SelectionListeDocuments($idType); 
			if(count($listeDocuments) > 0)
			{
			?>
			<br />
			BONS DE COMMANDE
			<table>
				<tr>
					<td><label class="colonne1"><center><strong>NOM</strong></center></label></td>
					<td><label class="colonne2"><center><strong>DATE</strong></center></label></td>
					<td><label class="colonne3"><center><strong>FOURNISSEUR</strong></center></label></td>
					<td><label class="colonne4"><center><strong>NET A PAYER</strong></center></label></td>
				</tr>
				<?php	
				foreach($listeDocuments as $document)
				{
					$donneesFournisseur = SelectionDonneesFournisseur($document['ID_FOURNISSEUR']);
					$nomFournisseur = $donneesFournisseur['NOM'];
					?>
					<tr>
						<td><label class="colonne1"><center><strong><?php echo $document['NOM']; ?></strong></center></label></td>
						<td><label class="colonne2"><center><strong><?php echo $document['DATE']; ?></strong></center></label></td>
						<td><label class="colonne3"><center><strong><?php echo $nomFournisseur; ?></strong></center></label></td>
						<td><label class="colonne4"><center><strong><?php echo $document['NET_A_PAYER']; ?></strong></center></label></td>
						<form method="post" action="inde_telechargerDocument.php" enctype="multipart/form-data">
						<td>
							<input type="hidden" name="nomDocument" value="<?php echo './archives/-'.$document['ID_DOCUMENT'].'-'.$document['NOM']; ?>" />
							<input type="submit" name="submit" value="Telecharger" />
						</td>	
						</form>
					</tr>
					<?php
				}
				?>
			</table>	

			<?php
			}
			$idType = 3;
			$listeDocuments = SelectionListeDocuments($idType); 
			if(count($listeDocuments) > 0)
			{
			?>
			<br />
			DOCUMENTS INTERNES
			<table>
				<tr>
					<td><label class="colonne1"><center><strong>NOM</strong></center></label></td>
					<td><label class="colonne2"><center><strong>DATE</strong></center></label></td>
				</tr>
				<?php	
				foreach($listeDocuments as $document)
				{
					?>
					<tr>
						<td><label class="colonne1"><center><strong><?php echo $document['NOM']; ?></strong></center></label></td>
						<td><label class="colonne2"><center><strong><?php echo $document['DATE']; ?></strong></center></label></td>
						<form method="post" action="inde_telechargerDocument.php" enctype="multipart/form-data">
						<td>
							<input type="hidden" name="nomDocument" value="<?php echo './archives/-'.$document['ID_DOCUMENT'].'-'.$document['NOM']; ?>" />
							<input type="submit" name="submit" value="Telecharger" />
						</td>	
						</form>
					</tr>
					<?php
				}
				?>
			</table>
			<?php
			}
			?>
		</div>
	</body>
</html>
