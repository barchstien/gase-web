<?php
	require("fonctions_bd_gase.php");

/*** DOCUMENTS ***/	
	function SelectionListeTypesDoc()
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT ID_TYPE, NOM FROM _inde_TYPE_DOC ORDER BY NOM");
		while ( $row = mysql_fetch_array($result))
		{
			$listeTypesDoc[$row[ID_TYPE]] = $row[NOM];
		}
		
		FermerConnectionBDD($connection);
		
		return $listeTypesDoc;
	}

	function SelectionNomTypeDoc($idType)
	{
		$connection = ConnectionBDD();
		
		$result = mysql_query("SELECT NOM FROM _inde_TYPE_DOC WHERE ID_TYPE = '$idType'");
		while ( $row = mysql_fetch_array($result))
		{		
			$nomType = $row[0];
		}
		
		FermerConnectionBDD($connection);
		
		return $nomType;
	}

	function SelectionIdDocument()
	{
		$connection = ConnectionBDD();
		
		$result = mysql_query("SELECT MAX(ID_DOCUMENT) FROM _inde_DOCUMENTS");
		while ( $row = mysql_fetch_array($result))
		{		
			$idDocument = $row[0];
		}
		
		FermerConnectionBDD($connection);
		
		return $idDocument;
	}
	
	function EnregistrerNouvelleFacture($idType, $nom, $idFournisseur, $date, $net)
	{
		$connection = ConnectionBDD();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType','$idFournisseur','$date','$net')";
		mysql_query($requete);
		
		FermerConnectionBDD($connection);
	}
	
	function EnregistrerNouveauBonCde($idType, $nom, $idFournisseur, $date, $net)
	{
		$connection = ConnectionBDD();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType','$idFournisseur','$date','$net')";
		mysql_query($requete);
		
		FermerConnectionBDD($connection);
	}
	
	function EnregistrerNouveauDocInterne($idType, $nom, $date)
	{
		$connection = ConnectionBDD();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType',NULL,'$date', NULL)";
		mysql_query($requete);
		
		FermerConnectionBDD($connection);
	}


	function SelectionListeDocuments($idType)
	{
		$connection = Connection	
/*** FOURNISSEURS ***/
	
	function SelectionDonneesFournisseur($idFournisseur)
	{
		$connection = ConnectionBDD();

		$result = mysql_query("SELECT NOM, ADRESSE, TELEPHONE_FIXE FROM _inde_FOURNISSEURS WHERE ID_FOURNISSEUR = '$idFournisseur'");
		while ( $row = mysql_fetch_array($result))
		{		
			$donnees['NOM'] = $row[0];
			$donnees['ADRESSE_POSTALE'] = $row[1];
			$donnees['TELEPHONE'] = $row[2];
		}

		FermerConnectionBDD($connection);
		
		return $donnees;
	}
/*************************/BDD();

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

		FermerConnectionBDD($connection);
		
		return $listeDoc;
	}	
	
	
?>
