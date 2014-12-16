<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
		<title>COMPTE</title>
    </head>

	<?php
	require("inde_fonctionsMC.php");
	require("inde_fonctionsAD.php");
	
	$idAdherent = $_POST['adherent'];

	$solde = SelectionSoldeAdherentMC($idAdherent);	
	$tabVersements = SelectionVersementsMC($idAdherent);
	?>
	
    <body>
		<?php include 'inde_menu.php'; ?>
		
		<div style="text-align:center">
			<form id="formulaire" method="post" action="inde_soldeAdherentMC.php">
				<select name="adherent" id="adherent" onchange="this.form.submit()">
					<?php	
					$listeAD = SelectionListeAD();
					foreach($listeAD as $donnees)
					{
						if($donnees['ID_ADHERENT'] == $idAdherent)
						{
							?>
							<option value="<?php echo $donnees['ID_ADHERENT']; ?>" selected="selected"><?php echo $donnees['PRENOM'] . ' ' . $donnees['NOM']; ?></option>
							<?php
						}
						else
						{
							?>
							<option value="<?php echo $donnees['ID_ADHERENT']; ?>"><?php echo $donnees['PRENOM'] . ' ' . $donnees['NOM']; ?></option>
							<?php
						}
					}
					?>
				</select>	
			</form>
			
			<br />
			Solde : <?php echo round($solde,2); ?> euros.
			<br />
			<br />			
			
			<?php
			if(!empty($tabVersements))
			{
				echo '<br />';
				echo 'Liste des mouvements :';
				echo '<br />';
				echo '<br />';
				foreach($tabVersements as $cle => $element)
				{
					echo round($element,2) . ' euros le ' . $cle . '<br />';
				}
			}
			?>
		</div>
	</body>
</html>


