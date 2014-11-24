<?php
	function ConnexionBDD_DOCU()
	{
		if(!$connexion)
		{	
			$connection = mysql_connect("localhost", "gase", "gasepass") or die(mysql_error());
			mysql_select_db("gasedl") or die(mysql_error());
		}	
	}
	
	function FermerConnexionBDD_DOCU($connexion)
	{
		mysql_close($connection);
	}

/*** DOCUMENTS ***/	
	function SelectionListeTypesDoc()
	{
		$connexion = ConnexionBDD_DOCU();

		$result = mysql_query("SELECT ID_TYPE, NOM FROM _inde_TYPE_DOC ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeTypesDoc[$row[ID_TYPE]] = $row[NOM];
		}
		
		FermerConnexionBDD_DOCU($connexion);
		
		return $listeTypesDoc;
	}

	function SelectionNomTypeDoc($idType)
	{
		$connexion = ConnexionBDD_DOCU();
		
		$result = mysql_query("SELECT NOM FROM _inde_TYPE_DOC WHERE ID_TYPE = '$idType'");
		while ( $row = mysql_fetch_array($result))
		{		
			$nomType = $row[0];
		}
		
		FermerConnexionBDD_DOCU($connexion);
		
		return $nomType;
	}

	function SelectionIdDocument()
	{
		$connexion = ConnexionBDD_DOCU();
		
		$result = mysql_query("SELECT MAX(ID_DOCUMENT) FROM _inde_DOCUMENTS");
		while ( $row = mysql_fetch_array($result))
		{		
			$idDocument = $row[0];
		}
		
		FermerConnexionBDD_DOCU($connexion);
		
		return $idDocument;
	}
	
	function EnregistrerNouvelleFacture($idType, $nom, $idFournisseur, $date, $net)
	{
		$connexion = ConnexionBDD_DOCU();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType','$idFournisseur','$date','$net')";
		mysql_query($requete);
		
		FermerConnexionBDD_DOCU($connexion);
	}
	
	function EnregistrerNouveauBonCde($idType, $nom, $idFournisseur, $date, $net)
	{
		$connexion = ConnexionBDD_DOCU();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType','$idFournisseur','$date','$net')";
		mysql_query($requete);
		
		FermerConnexionBDD_DOCU($connexion);
	}
	
	function EnregistrerNouveauDocInterne($idType, $nom, $date)
	{
		$connexion = ConnexionBDD_DOCU();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType',NULL,'$date', NULL)";
		mysql_query($requete);
		
		FermerConnexionBDD_DOCU($connexion);
	}
	
/*** FOURNISSEURS ***/
	function SelectionListeFournisseurs()
	{
		$connexion = ConnexionBDD_DOCU();

		$result = mysql_query("SELECT ID_FOURNISSEUR, NOM FROM _inde_FOURNISSEURS ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeFournisseurs[$row[ID_FOURNISSEUR]] = $row[NOM];
		}
		
		FermerConnexionBDD_DOCU($connexion);
		
		return $listeFournisseurs;
	}
	
	function SelectionDonneesFournisseur($idFournisseur)
	{
		$connexion = ConnexionBDD_DOCU();

		$result = mysql_query("SELECT NOM, ADRESSE, TELEPHONE_FIXE FROM _inde_FOURNISSEURS WHERE ID_FOURNISSEUR = '$idFournisseur'");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['NOM'] = $row[0];
			$donnees['ADRESSE_POSTALE'] = $row[1];
			$donnees['TELEPHONE'] = $row[2];
		}

		FermerConnexionBDD_DOCU($connexion);
		
		return $donnees;
	}
/*************************/

	function SelectionListeDocuments($idType)
	{
		$connexion = ConnexionBDD_DOCU();

		$compteur = 0;
		
		$result = mysql_query("SELECT ID_DOCUMENT, NOM, DATE, ID_FOURNISSEUR, NET_A_PAYER FROM _inde_DOCUMENTS WHERE ID_TYPE = '$idType' ORDER BY ID_DOCUMENT");
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

		FermerConnexionBDD_DOCU($connexion);
		
		return $listeDoc;
	}	
	
	
?>
