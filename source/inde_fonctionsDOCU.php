<?php
	require("fonctions_bd_gase.php");

/*** DOCUMENTS ***/	
	function SelectionListeTypesDoc()
	{
		$connection = ConnectionBDD();
		$result = $connection->query("SELECT ID_TYPE, NOM FROM _inde_TYPE_DOC ORDER BY NOM");
		while ( $row = $result->fetch_array())
		{
			$listeTypesDoc[$row[ID_TYPE]] = $row[NOM];
		}
		FermerConnectionBDD($connection);
		return $listeTypesDoc;
	}

	function SelectionNomTypeDoc($idType)
	{
		$connection = ConnectionBDD();
		$result = $connection->query("SELECT NOM FROM _inde_TYPE_DOC WHERE ID_TYPE = '$idType'");
		while ( $row = $result->fetch_array())
		{		
			$nomType = $row[0];
		}
		FermerConnectionBDD($connection);
		return $nomType;
	}

	function SelectionIdDocument()
	{
		$connection = ConnectionBDD();
		$result = $connection->query("SELECT MAX(ID_DOCUMENT) FROM _inde_DOCUMENTS");
		while ( $row = $result->fetch_array())
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
		$connection->query($requete);
		
		FermerConnectionBDD($connection);
	}
	
	function EnregistrerNouveauBonCde($idType, $nom, $idFournisseur, $date, $net)
	{
		$connection = ConnectionBDD();

		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType','$idFournisseur','$date','$net')";
		$connection->query($requete);
		
		FermerConnectionBDD($connection);
	}
	
	function EnregistrerNouveauDocInterne($idType, $nom, $date)
	{
		$connection = ConnectionBDD();
		$requete = "INSERT INTO _inde_DOCUMENTS (NOM, ID_TYPE, ID_FOURNISSEUR, DATE, NET_A_PAYER) values('$nom','$idType',NULL,'$date', NULL)";
		$connection->query($requete);
		FermerConnectionBDD($connection);
	}
	

	function SelectionListeDocuments($idType)
	{
		$connection = ConnectionBDD();
		$compteur = 0;
		$listeDoc = array();
		$result = $connection->query("SELECT ID_DOCUMENT, NOM, DATE, ID_FOURNISSEUR, NET_A_PAYER FROM _inde_DOCUMENTS WHERE ID_TYPE = '$idType' ORDER BY ID_DOCUMENT");
		while ( $row = $result->fetch_array())
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
