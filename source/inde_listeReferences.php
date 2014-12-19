<?php
//	$idCategorie = $_GET['idCategorie'];
$idCategorie = $_SESSION['inde_idCategorie'];
$listeReferences = SelectionListeReferencesMenu($idCategorie);
?>
	<form id="formulaire" method="post" action="inde_versPanier.php">
		<div><font color="red">Validez vos choix avec le boutton "Dans panier"</font>
		    <input type="submit" value="Dans panier" name="acheterRef" id="acheterRef">
		</div>

		<div id= "table_reference_list">
			<table>
				<tr>
				   <td><label width="3%" align="center" class="colonne1"><center><strong>QTE<br />(unite-kg)</strong></center></label></td>
				   <td><label class="colonne2"><center><strong>REFERENCE</strong></center></label></td>
				   <td><label class="colonne3"><center><strong>PRIX<br />(Qte 1)</strong></center></label></td>
				   <td><label class="colonne4"><center><strong>PRODUCTEUR</strong></center></label></td>
			   </tr>

				<?php
				if(count($listeReferences) > 0)
				{
					$_SESSION['inde_listeRef'] = array();
					foreach( $listeReferences as $tableau ) 
					{
						array_push( $_SESSION['inde_listeRef'],$tableau['ID_REFERENCE']);
						?>
						<tr>
							<?php
							if($tableau['VRAC'] == 0)
							{
								?>
								<td><select width="3%" class="colonne1" name="qte_<?php echo $tableau['ID_REFERENCE'];?>" id="qte_<?php echo $tableau['ID_REFERENCE'];?>">
									<option value="0" selected="selected">0</option>
									<option value="1" >1</option>
									<option value="2" >2</option>
									<option value="3" >3</option>
									<option value="4" >4</option>
									<option value="5" >5</option>
									<option value="6" >6</option>
									<option value="7" >7</option>
									<option value="8" >8</option>
									<option value="9" >9</option>	
								</select></td>
								<?php
							}
							else
							{
								?>
								<td>
								<input size="3" type= "text" class= "colonne1" alt="Quantite en kg ou litre" title="Quantite en kg ou litre" name="qte_<?php echo $tableau['ID_REFERENCE'];?>" id="qte_<?php echo $tableau['ID_REFERENCE'];?>" />
								</td>
								<?php
							}
							?>
							<td><label class="colonne2"><?php echo "&nbsp;".$tableau['REFERENCE']."&nbsp;"; ?></label></td>
							<td><label class="colonne3"><center><?php echo "&nbsp;".$tableau['PRIX']."&nbsp;"; ?></center></label></td>					
							<td><label class="colonne4"><?php echo "&nbsp;".$tableau['PRODUCTEUR']."&nbsp;"; ?></label>
							    <input type="hidden" name="nom_<?php echo $tableau['ID_REFERENCE'];?>" value="<?php echo $tableau['REFERENCE'];?>" />
							    <input type="hidden" name="prix_<?php echo $tableau['ID_REFERENCE'];?>" value="<?php echo $tableau['PRIX'];?>" />
							</td>
						</tr>
						<?php
					}
				}
				?>
			</table>	
		</div>
	</form>

