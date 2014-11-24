<?php
	function ConnexionBDD()
	{
		if(!$connexion)
		{	
			$connection = mysql_connect("localhost", "gase", "gasepass") or die(mysql_error());
			mysql_select_db("gasedl") or die(mysql_error());
		}	
	}
	
	function FermerConnexionBDD($connexion)
	{
		mysql_close($connection);
	}

	/*** JOURNAL DE BORD OUTIL ***/
	function EnregistrerInfoOutil($message)
	{
		$connexion = ConnexionBDD();

		$requete = "INSERT INTO _inde_VIE_OUTIL (DATE, MESSAGE) values(NOW(),'$message')";
		mysql_query($requete);
		
		FermerConnexionBDD($connexion);
	}
	
	
	function SelectionListeMessages()
	{
		$connexion = ConnexionBDD();

		$compteur = 0;
		
		$result = mysql_query("SELECT DATE, MESSAGE FROM _inde_VIE_OUTIL ORDER BY DATE DESC");
		while ( $row = mysql_fetch_array($result))
		{
			$donnees['DATE'] = $row[0];
			$donnees['MESSAGE'] = $row[1];
			
			$listeMsg[$compteur] = $donnees;
			$compteur++;
		}
		
		FermerConnexionBDD($connexion);
		
		return $listeMsg;
	}

	
	
	
	
	/*** DOCUMENTS ***/	
/*
	function SelectionNomTypeDoc($idType)
	{
		$connexion = ConnexionBDD();
		
		$result = mysql_query("SELECT NOM FROM _inde_TYPE_DOC WHERE ID_TYPE = '$idType'");
		while ( $row = mysql_fetch_array($result))
		{		
			$nomType = $row[0];
		}
		
		FermerConnexionBDD($connexion);
		
		return $nomType;
	}

	function SelectionIdDocument()
	{
		$connexion = ConnexionBDD();
		
		$result = mysql_query("SELECT MAX(ID_DOCUMENT) FROM _inde_DOCUMENTS");
		while ( $row = mysql_fetch_array($result))
		{		
			$idDocument = $row[0];
		}
		
		FermerConnexionBDD($connexion);
		
		return $idDocument;
	}
	
	
	
	function EnregistrerNouveauBonCde($idType, $nom, $idFournisseur, $date, $net)
	{
		$connexion = ConnexionBDD();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType','$idFournisseur','$date','$net')";
		mysql_query($requete);
		
		FermerConnexionBDD($connexion);
	}
	
	function EnregistrerNouveauDocInterne($idType, $nom, $date)
	{
		$connexion = ConnexionBDD();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType',NULL,'$date', NULL)";
		mysql_query($requete);
		
		FermerConnexionBDD($connexion);
	}
*/	
/*** FOURNISSEURS ***/
/*	function SelectionListeFournisseurs()
	{
		$connexion = ConnexionBDD();

		$result = mysql_query("SELECT ID_FOURNISSEUR, NOM FROM _inde_FOURNISSEURS ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeFournisseurs[$row[ID_FOURNISSEUR]] = $row[NOM];
		}
		
		FermerConnexionBDD($connexion);
		
		return $listeFournisseurs;
	}
	
	function SelectionDonneesFournisseur($idFournisseur)
	{
		$connexion = ConnexionBDD();

		$result = mysql_query("SELECT NOM, ADRESSE, TELEPHONE_FIXE FROM _inde_FOURNISSEURS WHERE ID_FOURNISSEUR = '$idFournisseur'");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['NOM'] = $row[0];
			$donnees['ADRESSE_POSTALE'] = $row[1];
			$donnees['TELEPHONE'] = $row[2];
		}

		FermerConnexionBDD($connexion);
		
		return $donnees;
	}
*/
/*************************/
/*
	function SelectionListeDocuments($idType)
	{
		$connexion = ConnexionBDD();

		$compteur = 0;
		
		$result = mysql_query("SELECT ID_DOCUMENT, NOM, DATE, ID_FOURNISSEUR, NET_A_PAYER FROM _inde_DOCUMENTS WHERE ID_TYPE = '$idType' ORDER BY DATE, NOM");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['ID_DOCUMENT'] = $row[0];
			$donnees['NOM'] = $row[1];
			$donnees['DATE'] = $row[2];
			$donnees['ID_FOURNISSEUR'] = $row[3];
			$donnees['NET_A_PAYER'] = $row[4];
			
			$listeDoc[$compteur] = $donnees;
			$compteur++;
		}

		FermerConnexionBDD($connexion);
		
		return $listeDoc;
	}	
*/	
	
	
?>
