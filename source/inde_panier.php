
<?php
require("inde_fonctionsMC.php");
$soldeAdherent = SelectionSoldeAdherentMC($_SESSION['inde_adherent']);
$nbRefPanier = $_SESSION['inde_nbRefPanier'];
if ( $nbRefPanier == 0)
{
	echo "<div>Votre panier est vide.</div>";
}
else
{
	$prixTotal=$_SESSION['inde_montantPanier'];
	?>
	<form id="formulaire" method="post" action="inde_payer.php">
		<div>-***- Montant MoneyCoop: <?php echo round($soldeAdherent,2) ?> euros -***-</div>
		
		<div 
		<?php if($prixTotal > $soldeAdherent){ ?>
			style="color: #FF0000" >** ATTENTION ** Total TTC panier: <?php echo round($prixTotal,2) ?> euros
		<?php }else{ ?>
			>Total TTC panier: <?php echo round($prixTotal,2) ?> euros
		<?php } ?>
		    <input type="submit" value="Payer" name="payer" id="payer">
		</div>

		<div id= "table_reference_list">
			<table>
				<tr>
					<td width="80%" align="center"><strong>DESIGNATION</strong></td>
					<td width="10%" align="center"><strong>QTE</strong></td>
					<td width="10%" align="center"><strong>PRIX</strong></td>
				</tr>
				<?php
				for ($i=0 ;$i < $nbRefPanier ; $i++)
				{
					?>
					<tr>
						<td width="78%"><?php echo $_SESSION['inde_panier']['nomReference'][$i];?></td>
						<td width="9%"><?php echo $_SESSION['inde_panier']['qteReference'][$i];?></td>
						<td width="9%"><?php echo round($_SESSION['inde_panier']['prixReference'][$i],2);?></td>
						<td width="4%">
							<a href="inde_retirer.php?idRef=<?php echo $_SESSION['inde_panier']['idRef'][$i]; ?>"><img src="../static/img_trash.png" title="Retirer du panier" alt="X" /></a>
						</td>
					</tr>
					<?php
				}
				?>			
			</table>
		</div>
	</form>
	<?php
}
?>

