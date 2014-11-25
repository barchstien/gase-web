<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
		<!-- En-tête de la page -->
        <meta charset="utf-8" />
		<link rel="stylesheet" href="inde_1AchatsAdherent.css" />
		<link rel="stylesheet" href="style_default.css" />
		<title>ACHATS</title>
    </head>

	<?php
	require("inde_fonctionsAD.php");
	
	if (isset($_POST['adherent'])) 
	{
		$_SESSION['inde_adherent'] = $_POST['adherent'];
	}
	
	$identiteAdherent = SelectionPrenomNomAdherent($_SESSION['inde_adherent']);
	
	$_SESSION['inde_montantPanier'] = 0;
	$_SESSION['inde_nbRefPanier'] = 0;
	$_SESSION['inde_panier']['idRef'] = array();
	$_SESSION['inde_panier']['nomReference'] = array();
	$_SESSION['inde_panier']['qteReference'] = array();
	$_SESSION['inde_panier']['prixReference'] = array();

	//include 'inde_menuAchats.php';
	?>
	
    <body>
        <?php include 'inde_menuAchats.php'; ?>
		Bonjour <strong><?php echo $identiteAdherent; ?></strong>
		<br />
		Choisissez une categorie de produits pour commencer vos achats.
		<br />
		<br />
		Historique de vos achats :
		<br />
	
	<?php
	$listeAchats = SelectionListeAchatsAdherent($_SESSION['inde_adherent']);
	if(count($listeAchats) != 0)
	{
	?>
	
	<div>
		<table>
			<tr>
				<td><label class="colonne1"><strong>ID</strong></label></td>
				<td><label class="colonne2"><strong>Montant TTC</strong></label></td>
				<td><label class="colonne3"><strong>Nb references</strong></label></td>
				<td><label class="colonne4"><strong>Date achats</strong></label></td>
			</tr>
		
			<?php
			foreach( $listeAchats as $tableau ) 
			{
				?>
				<tr>
					<td><?php echo "&nbsp;".$tableau['ID_ACHATS']."&nbsp;"; ?></td>
					<td><?php echo "&nbsp;".$tableau['MONTANT']."&nbsp;"; ?></td>
					<td><?php echo "&nbsp;".$tableau['NB_ARTICLES']."&nbsp;"; ?></td>
					<td><?php echo "&nbsp;".$tableau['DATE_ACHATS']."&nbsp;"; ?></td>
					<td><a href="inde_detailAchatsAdherent.php?idAch=<?php echo $tableau['ID_ACHATS']; ?>" class="bouton" >Voir le detail</a></td>
				</tr>
				<?php
			}
			?>
		</table>
	</div>
	<?php
	}
	else
	{
		echo 'Aucun achat pour le moment.';
	}
	?>
    </body>
</html>
