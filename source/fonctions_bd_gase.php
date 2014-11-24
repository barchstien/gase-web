<?php
    //this file was originally un-used, while it should be used by all !!!!!!!!

	function ConnectionBDD(){
	    //tihs creates an error, should probably make a global variable of $connection
		//if(!$connection){	
			$connection = mysql_connect("localhost", "gase", "gasepass") or die(mysql_error());
			mysql_select_db("gasedl") or die(mysql_error());
			
		//}
	    return $connection;
	}
	
	function FermerConnectionBDD($connection)
	{
		mysql_close($connection);
	}

//////////TODO compare those functions with what's in inde_fonctionsACH.php, coz it's was the working one

    //this is original function
    /**
	function EnregistrerAchatAdherent($idAdherent, $montantTTC, $nbArticles){
		$connection = ConnexionBDD();

		mysql_query("INSERT INTO achats (date_achat,id_adherent,total_TTC,nb_references) values(timestamp(),'$idAdherent','$montantTTC','$nbArticles')");
		$idCommande = mysql_insert_id();
		
		mysql_close($connection);

		return $idCommande;
	}*/
	//this is imported from inde_fonctionsACH.php
	function EnregistrerAchatAdherent($idAdherent, $montantTTC, $nbArticles){
		$connection = ConnectionBDD();

//		mysql_query("LOCK TABLES _inde_ACHATS WRITE");
//		mysql_query("SET AUTOCOMMIT = 0");
		mysql_query("INSERT INTO _inde_ACHATS (DATE_ACHAT,ID_ADHERENT,TOTAL_TTC,NB_REFERENCES) values(NOW(),'$idAdherent','$montantTTC','$nbArticles')", $connection);
//		mysql_select_db('nouvelle_independante');
		$idCommande = mysql_insert_id();
//		mysql_query("COMMIT");
//		mysql_query("UNLOCK TABLES");
		
		FermerConnectionBDD($connection);

		return $idCommande;
	}
	
	/**
	function SelectionInfosAchats($idAchats){
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT DATE_ACHAT, TOTAL_TTC, NB_REFERENCES FROM _inde_ACHATS WHERE ID_ACHAT = '$idAchats'");
		while ( $row = mysql_fetch_array($result))
		{
			$infosAchats = 'Detail des achats numero '. $idAchats . ' du ' . $row[DATE_ACHAT] . ', d un montant de  ' . $row[TOTAL_TTC] . ' euros ('.$row[NB_REFERENCES].' references).';
		}
		
		FermerConnectionBDD($connection);
		
		return $infosAchats;
	}*/
	//this is imported from inde_fonctionsACH.php
	function SelectionInfosAchats($idAchats){
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT DATE_ACHAT, TOTAL_TTC, NB_REFERENCES FROM _inde_ACHATS WHERE ID_ACHAT = '$idAchats'", $connection);
		$infosAchats = 0;
		while ( $row = mysql_fetch_array($result))
		{
			$infosAchats = 'Detail des achats numero '. $idAchats . ' du ' . $row[DATE_ACHAT] . ', d un montant de  ' . $row[TOTAL_TTC] . ' euros ('.$row[NB_REFERENCES].' references).';
		}
		
		FermerConnectionBDD($connection);
		
		return $infosAchats;
	}
	
	
	/**function SelectionDetailsAchats($idAchats){
		$connection = ConnectionBDD();

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

		FermerConnectionBDD($connection);
		
		return $listeRef;
	}*/
	//this is imported from inde_fonctionsACH.php
	function SelectionDetailsAchats($idAchats){
	    //echo ("SelectionDetailsAchats\n");
		$connection = ConnectionBDD();

		$compteur = 0;
		
		$result = mysql_query("SELECT r.DESIGNATION, r.PRIX_TTC, c.QUANTITE, r.PRIX_TTC*c.QUANTITE, c.ID_REFERENCE FROM _inde_STOCKS c, _inde_REFERENCES r WHERE c.ID_ACHAT = '$idAchats' AND r.ID_REFERENCE = c.ID_REFERENCE", $connection);
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

		FermerConnectionBDD($connection);
		
		return $listeRef;
	}
	
?>
