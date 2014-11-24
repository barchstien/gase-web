<?php
	function ConnexionBDD_ACH()
	{
		if(!$connexion)
		{	
			$connection = mysql_connect("localhost", "root", "Rouss7tte") or die(mysql_error());
			mysql_select_db("gasedl") or die(mysql_error());
		}	
	}
	
	function FermerConnexionBDD_ACH($connexion)
	{
		mysql_close($connection);
	}

	function EnregistrerAchatAdherent($idAdherent, $montantTTC, $nbArticles)
	{
		$connexion = ConnexionBDD_ACH();

//		mysql_query("LOCK TABLES _inde_ACHATS WRITE");
//		mysql_query("SET AUTOCOMMIT = 0");
		mysql_query("INSERT INTO _inde_ACHATS (DATE_ACHAT,ID_ADHERENT,TOTAL_TTC,NB_REFERENCES) values(NOW(),'$idAdherent','$montantTTC','$nbArticles')");
//		mysql_select_db('nouvelle_independante');
		$idCommande = mysql_insert_id();
//		mysql_query("COMMIT");
//		mysql_query("UNLOCK TABLES");
		
		FermerConnexionBDD_ACH($connexion);

		return $idCommande;
	}
	
	function SelectionInfosAchats($idAchats)
	{
		$connexion = ConnexionBDD_ACH();

		$result = mysql_query("SELECT DATE_ACHAT, TOTAL_TTC, NB_REFERENCES FROM _inde_ACHATS WHERE ID_ACHAT = '$idAchats'");
		while ( $row = mysql_fetch_array($result))
		{
			$infosAchats = 'Detail des achats numero '. $idAchats . ' du ' . $row[DATE_ACHAT] . ', d un montant de  ' . $row[TOTAL_TTC] . ' euros ('.$row[NB_REFERENCES].' references).';
		}
		
		FermerConnexionBDD_ACH($connexion);
		
		return $infosAchats;
	}
	
	function SelectionDetailsAchats($idAchats)
	{
		$connexion = ConnexionBDD_ACH();

		$compteur = 0;
		
		$result = mysql_query("SELECT r.DESIGNATION, r.PRIX_TTC, c.QUANTITE, r.PRIX_TTC*c.QUANTITE, c.ID_REFERENCE FROM _inde_STOCKS c, _inde_REFERENCES r WHERE c.ID_ACHAT = '$idAchats' AND r.ID_REFERENCE = c.ID_REFERENCE");
		while ( $row = mysql_fetch_array($result))
		{		
			$ligne['DESIGNATION'] = $row[0];
			$ligne['PRIX_TTC'] = $row[1];
			$ligne['QUANTITE'] = $row[2];
			$ligne['TOTAL'] = ROUND($row[3],2);
			$ligne['ID_REFERENCE'] = $row[4];
			
			$listeRef[$compteur] = $ligne;
			$compteur++;
		}

		FermerConnexionBDD_ACH($connexion);
		
		return $listeRef;
	}
	
?>
